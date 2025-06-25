<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FoundItems;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FoundItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FoundItems::query();

        // Handle search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('item_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('location', 'like', '%' . $searchTerm . '%');
            });
        }

        // Get paginated results (12 items per page)
        // return
        $foundItems = $query->with('image') // Eager load images to avoid N+1 query problem
            ->latest('found_date')
            ->latest('created_at')
            ->paginate(8)
            ->withQueryString(); // Preserve search params in pagination links

        return view('frontend.lost-found.found.list', compact('foundItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.lost-found.found.report_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'item_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'found_date' => 'required|date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'user_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
        ]);

        // Create found item
        $foundItem = FoundItems::create([
            'item_name' => $request->item_name,
            'location' => $request->location,
            'found_date' => $request->found_date,
            'description' => $request->description,
            'user_name' => $request->user_name,
            'contact_number' => $request->contact_number,
            'user_id' => auth()->check() ? auth()->id() : null,
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // ✅ fixed from 'file' to 'image'
            $locationName = 'images/found_items/';
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $destinationPath = env('PUBLIC_FILE_LOCATION')
                ? public_path('../' . $locationName)
                : public_path($locationName);

            // Ensure directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);
            $fullPath = $locationName . $fileName;

            // Save image record
            Image::create([
                'url' => $fullPath,
                'type' => $file->getClientOriginalExtension(),
                'parentable_id' => $foundItem->id,
                'parentable_type' => FoundItems::class,
            ]);
        }

        return redirect()->back()->with('success', 'Found item reported successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = FoundItems::findOrFail($id);
        return redirect()->route('found-items.index', request()->query())
            ->with('modal', $item->id);
    }



    public function destroy(FoundItems $foundItem)
    {
        // Check if user owns this item
        if (Auth::id() !== $foundItem->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete associated image file and DB record if it exists
        if ($foundItem->image) {
            $imagePath = public_path($foundItem->image->url);

            // Delete physical file
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            // Delete image record
            $foundItem->image->delete();
        }

        // Delete the found item
        $foundItem->delete();

        return redirect()->back()
            ->with('warning', 'Found item has been deleted successfully!');
    }


    /**
     * Get items for AJAX requests (for dynamic loading)
     */
    public function getItems(Request $request)
    {
        $query = FoundItems::query();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('item_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('location', 'like', '%' . $searchTerm . '%');
            });
        }

        $foundItems = $query->with('image') // Eager load images to avoid N+1 query problem
            ->latest('found_date')
            ->latest('created_at')
            ->paginate(12);

        return response()->json([
            'items' => $foundItems->items(),
            'pagination' => [
                'current_page' => $foundItems->currentPage(),
                'last_page' => $foundItems->lastPage(),
                'per_page' => $foundItems->perPage(),
                'total' => $foundItems->total(),
                'has_more_pages' => $foundItems->hasMorePages()
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoundItems $foundItems)
    {
        //
    }
}
