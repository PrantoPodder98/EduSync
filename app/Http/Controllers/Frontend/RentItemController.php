<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RentItem;
use App\Models\Order;
use Illuminate\Http\Request;

class RentItemController extends Controller
{
    public function index()
    {
        $query = RentItem::query();

        if (request()->has('search') && !empty(request()->search)) {
            $searchTerm = request()->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('brand', 'like', '%' . $searchTerm . '%')
                    ->orWhere('item_type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
            });
        }

        $rentItems = $query->where('status', 1)
            ->latest('created_at')
            ->paginate(4)
            ->withQueryString();

        return view('frontend.rent-items.list', compact('rentItems'));
    }

    public function create()
    {
        return view('frontend.rent-items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'item_type' => 'required|string|max:100',
            'rent_type' => 'required|in:daily,monthly',
            'rent_duration' => 'nullable|integer|min:1',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'user_name' => 'required|string|max:255',
            'user_location' => 'required|string|max:255',
            'user_contact' => 'required|string|max:255',
            'user_payment_option' => 'required',
            'user_bKash_number' => 'nullable|string|max:20',
        ]);

        $rentItem = RentItem::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'item_type' => $request->item_type,
            'rent_type' => $request->rent_type,
            'rent_duration' => $request->rent_duration,
            'price' => $request->price,
            'description' => $request->description,
            'user_name' => $request->user_name,
            'user_location' => $request->user_location,
            'user_contact' => $request->user_contact,
            'user_payment_option' => $request->user_payment_option,
            'user_bKash_number' => $request->user_payment_option === 'bKash' ? $request->user_bKash_number : null,
            'user_id' => auth()->id(),
            'status' => 1,
        ]);

        // Save images (if any)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $locationName = 'images/rent_items/';
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $destinationPath = env('PUBLIC_FILE_LOCATION')
                    ? public_path('../' . $locationName)
                    : public_path($locationName);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $fileName);
                $fullPath = $locationName . $fileName;

                $rentItem->images()->create([
                    'url' => $fullPath,
                    'type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Rent item added successfully!');
    }

    public function show(RentItem $rentItem)
    {
        // return
        $rentItem->load('images');

        return view('frontend.rent-items.show', compact('rentItem'));
    }

    public function edit(RentItem $rentItem)
    {
        $rentItem->load('images');

        if (auth()->id() !== $rentItem->user_id) {
            return redirect()->back()->with('error', 'You do not have permission to edit this rent item.');
        }

        return view('frontend.rent-items.edit', compact('rentItem'));
    }

    public function update(Request $request, RentItem $rentItem)
    {
        if (auth()->id() !== $rentItem->user_id) {
            return redirect()->back()->with('error', 'You do not have permission to update this rent item.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'item_type' => 'required|string|max:100',
            'rent_type' => 'required|in:daily,monthly',
            'rent_duration' => 'nullable|integer|min:1',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'user_name' => 'required|string|max:255',
            'user_location' => 'required|string|max:255',
            'user_contact' => 'required|string|max:255',
            'user_payment_option' => 'required',
            'user_bKash_number' => 'nullable|string|max:20',
        ]);

        $rentItem->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'item_type' => $request->item_type,
            'rent_type' => $request->rent_type,
            'rent_duration' => $request->rent_duration,
            'price' => $request->price,
            'description' => $request->description,
            'user_name' => $request->user_name,
            'user_location' => $request->user_location,
            'user_contact' => $request->user_contact,
            'user_payment_option' => $request->user_payment_option,
            'user_bKash_number' => $request->user_payment_option === 'bKash' ? $request->user_bKash_number : null,
        ]);



        // Save new images
        if ($request->hasFile('images')) {
            // Update images first delete old images
            foreach ($rentItem->images as $image) {
                $imagePath = public_path($image->url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }
            
            foreach ($request->file('images') as $file) {
                $locationName = 'images/rent_items/';
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $destinationPath = env('PUBLIC_FILE_LOCATION')
                    ? public_path('../' . $locationName)
                    : public_path($locationName);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $fileName);
                $fullPath = $locationName . $fileName;

                $rentItem->images()->create([
                    'url' => $fullPath,
                    'type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Rent item updated successfully!');
    }

    public function destroy(RentItem $rentItem)
    {
        if (auth()->id() !== $rentItem->user_id) {
            return redirect()->back()->with('error', 'You do not have permission to delete this rent item.');
        }

        $rentItem->delete();

        return redirect()->back()->with('warning', 'Rent item deleted successfully.');
    }

    public function myRentItems()
    {
        // return
        $rentItems = RentItem::where('user_id', auth()->id())
            ->with(['images', 'rentOrderItems.order'])
            ->latest('created_at')
            ->get();

        return view('frontend.rent-items.my-items', compact('rentItems'));
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        try {
            $rentOrder = Order::findOrFail($orderId);

            // Check if the authenticated user owns the rent item in this order
            // return
            $rentItemOwner = $rentOrder->rentOrderItems()
                ->whereHas('rentItem', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->exists();

            if (!$rentItemOwner) {
                return redirect()->back()->with('error', 'You are not authorized to update this order status.');
            }

            $rentOrder->update([
                'status' => $request->status,
                'payment_status' => in_array($request->status, ['processing', 'shipped', 'delivered']) ? 'completed' : 'pending',
            ]);

            return redirect()->back()->with('success', 'Rent item order status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating rent order status. Please try again.');
        }
    }
}
