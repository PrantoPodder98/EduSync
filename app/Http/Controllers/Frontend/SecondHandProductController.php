<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\SecondHandProduct;
use Illuminate\Http\Request;

class SecondHandProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = SecondHandProduct::query();

        // Handle search functionality
        if (request()->has('search') && !empty(request()->search)) {
            $searchTerm = request()->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('brand', 'like', '%' . $searchTerm . '%')
                    ->orWhere('item_type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
            });
        }

        // Get paginated results (12 items per page)
        $secondHandProducts = $query->with('images') // Eager load images to avoid N+1 query problem
            ->latest('created_at')
            ->paginate(4)
            ->withQueryString(); // Preserve search params in pagination links

        return view('frontend.second-hand-products.list', compact('secondHandProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.second-hand-products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all(); // For debugging purposes, remove this in production
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'item_type' => 'required|string|max:100',
            'item_state' => 'required|string|max:100',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'user_name' => 'required|string|max:255',
            'user_location' => 'required|string|max:255',
            'user_contact' => 'required|string|max:255',
        ]);

        // Save product
        $product = SecondHandProduct::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'item_type' => $request->item_type,
            'item_state' => $request->item_state,
            'price' => $request->price,
            'description' => $request->description,
            'user_name' => $request->user_name,
            'user_location' => $request->user_location,
            'user_contact' => $request->user_contact,
            'user_id' => auth()->id(), // Assuming the user is authenticated
        ]);

        // Save images (if any)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $locationName = 'images/second_hand_products/';
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $destinationPath = env('PUBLIC_FILE_LOCATION')
                    ? public_path('../' . $locationName)
                    : public_path($locationName);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $fileName);
                $fullPath = $locationName . $fileName;

                $product->images()->create([
                    'url' => $fullPath,
                    'type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Product added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(SecondHandProduct $secondHandProduct)
    {
        // Eager load images to avoid N+1 query problem
        $secondHandProduct->load('images');

        return view('frontend.second-hand-products.show', compact('secondHandProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SecondHandProduct $secondHandProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SecondHandProduct $secondHandProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SecondHandProduct $secondHandProduct)
    {
        //
    }

}
