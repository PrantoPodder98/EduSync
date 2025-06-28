<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RentCart;
use App\Models\RentItem;

class RentCartController extends Controller
{
    public function index()
    {
        // return
        $item = Auth::user()->rentCartWithItems()->first();

        if ($item != null) {
            if ($item->rentItem->rent_duration != 0) {
                $totalAmount = $item->rentItem->price * $item->rentItem->rent_duration;
            } else {
                $totalAmount = $item->rentItem->price;
            }
        } else {
            $item = null; // No item in cart
            $totalAmount = 0; // No items in cart
        }

        return view('frontend.cart.rent.index', compact('item', 'totalAmount'));
    }

    /**
     * Add product to cart
     */
    public function addToCart(Request $request, RentItem $rent_item)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart.');
        }

        $userId = Auth::id();

        // Check if user is trying to add their own product
        if ($rent_item->user_id == $userId) {
            return redirect()->back()->with('error', 'You cannot add your own item to cart.');
        }

        // Check if user already has a product in cart (only one allowed)
        $existingCartItem = RentCart::where('user_id', $userId)->first();
        if ($existingCartItem) {
            // If the existing product is the same as the one being added
            if ($existingCartItem->rent_item_id == $rent_item->id) {
                return redirect()->back()->with('info', 'Product is already in your cart!');
            } else {
                return redirect()->back()->with('error', 'You can only add one product to your cart at a time. Please purchase or remove the existing product first.');
            }
        }

        // Add new item to cart
        RentCart::create([
            'user_id' => $userId,
            'rent_item_id' => $rent_item->id
        ]);
        $message = 'Item added to cart successfully!';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove product from cart
     */
    public function removeFromCart(RentCart $cartItem)
    {
        // Check if the cart item belongs to the authenticated user
        if ($cartItem->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    /**
     * Get cart count for header/navbar
     */
    public function getCartCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = Auth::user()->rentCartItems()->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Clear all cart items
     */
    public function clearCart()
    {
        Auth::user()->rentCartItems()->delete();

        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }

    /**
     * Show checkout page
     */
    public function checkout()
    {
        $item = Auth::user()->rentCartWithItems()->first();

        if (!$item) {
            return redirect()->route('rent.cart.index')->with('error', 'Your cart is empty!');
        }

        if ($item->rentItem->rent_duration != 0) {
            $totalAmount = $item->rentItem->price * $item->rentItem->rent_duration;
        } else {
            $totalAmount = $item->rentItem->price;
        }

        return view('frontend.cart.rent.checkout', compact('item', 'totalAmount'));
    }
}
