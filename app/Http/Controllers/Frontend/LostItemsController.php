<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LostItems;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class LostItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = LostItems::query();

        // Handle search functionality
        if (request()->has('search') && !empty(request()->search)) {
            $searchTerm = request()->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('item_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('location', 'like', '%' . $searchTerm . '%');
            });
        }

        // Get paginated results (12 items per page)
        $lostItems = $query->with('image') // Eager load images to avoid N+1 query problem
            ->latest('lost_date')
            ->latest('created_at')
            ->paginate(8)
            ->withQueryString(); // Preserve search params in pagination links

        return view('frontend.lost-found.lost.list', compact('lostItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.lost-found.lost.report_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'lost_date' => 'required|date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'user_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
        ]);

        // return
        $lostItem = LostItems::create([
            'item_name' => $request->item_name,
            'location' => $request->location,
            'lost_date' => $request->lost_date,
            'description' => $request->description,
            'user_name' => $request->user_name,
            'contact_number' => $request->contact_number,
            'user_id' => auth()->check() ? auth()->id() : null,
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // ✅ fixed from 'file' to 'image'
            $locationName = 'images/lost_items/';
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
                'parentable_id' => $lostItem->id,
                'parentable_type' => LostItems::class,
            ]);
        }

        return redirect()->route('lost-items.index')->with('success', 'Lost item reported successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LostItems $lost_item)
    {
        // Check if user owns this item
        if (Auth::id() !== $lost_item->user_id) {
            return redirect()->back()->with('error', 'You do not have permission to delete this item.');
        }

        // Delete associated image if exists
        if ($lost_item->image) {
            $imagePath = public_path($lost_item->image->url);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $lost_item->image->delete();
        }

        // Delete the lost item
        $lost_item->delete();

        return redirect()->route('lost-items.index')->with('warning', 'Lost item deleted successfully.');
    }

    /**
     * Get items for AJAX requests (for dynamic loading)
     */
    public function getItems(Request $request)
    {
        $query = LostItems::query();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('item_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('location', 'like', '%' . $searchTerm . '%');
            });
        }

        $lostItems = $query->with('image') // Eager load images to avoid N+1 query problem
            ->latest('lost_date')
            ->latest('created_at')
            ->paginate(12);

        return response()->json([
            'items' => $lostItems->items(),
            'pagination' => [
                'current_page' => $lostItems->currentPage(),
                'last_page' => $lostItems->lastPage(),
                'per_page' => $lostItems->perPage(),
                'total' => $lostItems->total(),
                'has_more_pages' => $lostItems->hasMorePages()
            ]
        ]);
    }
}
