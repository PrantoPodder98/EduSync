<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RentalNoticeBoardAccommodation;

use Illuminate\Http\Request;

class RentalNoticeBoardAccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RentalNoticeBoardAccommodation::query()->where('status', 'active');

        if ($request->filled('division')) {
            $query->where('division', $request->division);
        }

        if ($request->filled('property_type')) {
            $query->where('property_type', $request->property_type);
        }

        if ($request->filled('rent_type')) {
            $query->where('rent_type', $request->rent_type);
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->bedrooms);
        }

        if ($request->filled('min_price')) {
            $query->where('rent_amount', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('rent_amount', '<=', $request->max_price);
        }

        $accommodations = $query
            // ->where('is_approved', 1)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('frontend.rental_notice_board_accommodations.index', [
            'accommodations' => $accommodations,
            'filters' => $request->only(['division', 'property_type', 'rent_type', 'bedrooms', 'min_price', 'max_price']),
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.rental_notice_board_accommodations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_no' => 'nullable|string|max:50',
            'property_type' => 'required|in:Flat,Hostel,Mess,Shared,House,Single',
            'division' => 'required|string|max:100',
            'area' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'map_link' => 'nullable|url',
            'rent_type' => 'required|in:monthly,daily',
            'rent_amount' => 'required|integer|min:0',
            'advance_amount' => 'required|integer|min:1',
            'utility_bill' => 'nullable|integer|min:0',
            'bedrooms' => 'required|integer|min:1|max:10',
            'bathrooms' => 'required|integer|min:1|max:10',
            'balcony' => 'nullable|integer|min:0|max:5',
            'size_sqft' => 'nullable|integer|min:0',
            'contact_name' => 'required|string|max:100',
            'contact_number' => 'required|string|max:15',
            'bank_name' => [
                'nullable',
                'string',
                'max:100',
                function ($attribute, $value, $fail) use ($request) {
                    $fields = [
                        'bank_name',
                        'bank_account_number',
                        'bank_routing_number'
                    ];
                    $filled = array_filter($fields, fn($f) => $request->filled($f));
                    if (count($filled) > 0) {
                        foreach ($fields as $field) {
                            if (!$request->filled($field)) {
                                $fail('All bank fields are required if any bank field is filled.');
                                break;
                            }
                        }
                    }
                }
            ],
            'bank_account_number' => 'nullable|string|max:50',
            'bank_routing_number' => 'nullable|string|max:50',
            'bkash_number' => 'nullable|string|max:15',
        ]);

        $rentalNotice = RentalNoticeBoardAccommodation::create([
            'title' => $request->title,
            'description' => $request->description,
            'unit_no' => $request->unit_no,
            'property_type' => $request->property_type,
            'division' => $request->division,
            'area' => $request->area,
            'address' => $request->address,
            'map_link' => $request->map_link,
            'rent_type' => $request->rent_type,
            'rent_amount' => $request->rent_amount,
            'advance_amount' => $request->advance_amount,
            'utility_bill' => $request->utility_bill,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'balcony' => $request->balcony,
            'size_sqft' => $request->size_sqft,
            'contact_name' => $request->contact_name,
            'contact_number' => $request->contact_number,
            'user_id' => auth()->id(),
            'status' => 'active',
            'is_approved' => 0,
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'bank_routing_number' => $request->bank_routing_number,
            'bkash_number' => $request->bkash_number,
        ]);

        // multiple images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $locationName = 'images/rental_notice_board_accommodations/';
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $destinationPath = env('PUBLIC_FILE_LOCATION')
                    ? public_path('../' . $locationName)
                    : public_path($locationName);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $fileName);
                $fullPath = $locationName . $fileName;

                $rentalNotice->images()->create([
                    'url' => $fullPath,
                    'type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->back()
            ->with('success', 'Accommodation added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RentalNoticeBoardAccommodation $rentalNotice)
    {
        $rentalNotice->load(['images', 'user']);

        return view('frontend.rental_notice_board_accommodations.show', [
            'rentalNotice' => $rentalNotice,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RentalNoticeBoardAccommodation $rentalNotice)
    {
        // Check if the authenticated user is the owner of the rental notice
        if ($rentalNotice->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to edit this rental notice.');
        }

        return
        $rentalNotice->load('images');

        return view('frontend.rental_notice_board_accommodations.edit', [
            'rentalNotice' => $rentalNotice,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RentalNoticeBoardAccommodation $rentalNotice)
    {
        // Check if the authenticated user is the owner of the rental notice
        if ($rentalNotice->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this rental notice.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_no' => 'nullable|string|max:50',
            'property_type' => 'required|in:Flat,Hostel,Mess,Shared,House,Single',
            'division' => 'required|string|max:100',
            'area' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'map_link' => 'nullable|url',
            'rent_type' => 'required|in:monthly,daily',
            'rent_amount' => 'required|integer|min:0',
            'advance_amount' => 'required|integer|min:1',
            'utility_bill' => 'nullable|integer|min:0',
            'bedrooms' => 'required|integer|min:1|max:10',
            'bathrooms' => 'required|integer|min:1|max:10',
            'balcony' => 'nullable|integer|min:0|max:5',
            'size_sqft' => 'nullable|integer|min:0',
            'contact_name' => 'required|string|max:100',
            'contact_number' => 'required|string|max:15',
            'status' => 'nullable|in:active,inactive,rented',
            'bank_name' => [
                'nullable',
                'string',
                'max:100',
                function ($attribute, $value, $fail) use ($request) {
                    $fields = [
                        'bank_name',
                        'bank_account_number',
                        'bank_routing_number'
                    ];
                    $filled = array_filter($fields, fn($f) => $request->filled($f));
                    if (count($filled) > 0) {
                        foreach ($fields as $field) {
                            if (!$request->filled($field)) {
                                $fail('All bank fields are required if any bank field is filled.');
                                break;
                            }
                        }
                    }
                }
            ],
            'bank_account_number' => 'nullable|string|max:50',
            'bank_routing_number' => 'nullable|string|max:50',
            'bkash_number' => 'nullable|string|max:15',
        ]);

        $rentalNotice->update([
            'title' => $request->title,
            'description' => $request->description,
            'unit_no' => $request->unit_no,
            'property_type' => $request->property_type,
            'division' => $request->division,
            'area' => $request->area,
            'address' => $request->address,
            'map_link' => $request->map_link,
            'rent_type' => $request->rent_type,
            'rent_amount' => $request->rent_amount,
            'advance_amount' => $request->advance_amount,
            'utility_bill' => $request->utility_bill,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'balcony' => $request->balcony,
            'size_sqft' => $request->size_sqft,
            'contact_name' => $request->contact_name,
            'contact_number' => $request->contact_number,
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'bank_routing_number' => $request->bank_routing_number,
            'bkash_number' => $request->bkash_number,
        ]);

        // Handle image updates
        if ($request->hasFile('images')) {
            // Delete existing images
            foreach ($rentalNotice->images as $image) {
                $imagePath = public_path($image->url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }

            // Upload new images
            foreach ($request->file('images') as $file) {
                $locationName = 'images/rental_notice_board_accommodations/';
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $destinationPath = env('PUBLIC_FILE_LOCATION')
                    ? public_path('../' . $locationName)
                    : public_path($locationName);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $fileName);
                $fullPath = $locationName . $fileName;

                $rentalNotice->images()->create([
                    'url' => $fullPath,
                    'type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->back()
            ->with('success', 'Rental notice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RentalNoticeBoardAccommodation $rentalNotice)
    {
        // Check if the authenticated user is the owner of the rental notice
        if ($rentalNotice->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this rental notice.');
        }

        // Delete associated images
        foreach ($rentalNotice->images as $image) {
            $imagePath = public_path($image->url);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }

        // Delete the rental notice
        $rentalNotice->delete();

        return redirect()->route('rental-notice.index')
            ->with('success', 'Rental notice deleted successfully.');
    }

    /**
     * Display a listing of the user's rental notices.
     */
    public function myRentalNotices()
    {
        $rentalNotices = RentalNoticeBoardAccommodation::where('user_id', auth()->id())
            ->with(['images', 'user', 'reservations'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.rental_notice_board_accommodations.my_rental_notices', [
            'rentalNotices' => $rentalNotices,
        ]);
    }

    public function updateReservationStatus(Request $request, $rentalNoticeId)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        try {
            $rentalNotice = RentalNoticeBoardAccommodation::findOrFail($rentalNoticeId);

            // Check if the authenticated user owns the rental notice
            if ($rentalNotice->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'You are not authorized to update this rental notice status.');
            }
            $rentalNotice->reservations()->update(['status' => $request->status]);

            return redirect()->back()->with('success', 'Rental notice reservation status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating order status. Please try again.');
        }
    }
}
