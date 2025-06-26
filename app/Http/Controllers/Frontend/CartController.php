<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\SecondHandProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart items
     */
    public function index()
    {
        $cartItems = Auth::user()->cartWithProducts()->get();
        $totalAmount = $cartItems->sum('total_price');

        return view('frontend.cart.index', compact('cartItems', 'totalAmount'));
    }

    /**
     * Add product to cart
     */
    public function addToCart(Request $request, SecondHandProduct $product)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart.');
        }

        $userId = Auth::id();

        // Check if user is trying to add their own product
        if ($product->user_id == $userId) {
            return redirect()->back()->with('error', 'You cannot add your own product to cart.');
        }

        // Check if user already has a product in cart (only one allowed)
        $existingCartItem = Cart::where('user_id', $userId)->first();
        if ($existingCartItem) {
            // If the existing product is the same as the one being added
            if ($existingCartItem->second_hand_product_id == $product->id) {
                return redirect()->back()->with('info', 'Product is already in your cart!');
            } else {
                return redirect()->back()->with('error', 'You can only add one product to your cart at a time. Please purchase or remove the existing product first.');
            }
        }

        // Add new item to cart
        Cart::create([
            'user_id' => $userId,
            'second_hand_product_id' => $product->id
        ]);
        $message = 'Product added to cart successfully!';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove product from cart
     */
    public function removeFromCart(Cart $cartItem)
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

        $count = Auth::user()->cartItems()->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Clear all cart items
     */
    public function clearCart()
    {
        Auth::user()->cartItems()->delete();

        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }

    /**
     * Show checkout page
     */
    public function checkout()
    {
        $cartItems = Auth::user()->cartWithProducts()->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $totalAmount = $cartItems->sum('total_price');

        return view('frontend.cart.checkout', compact('cartItems', 'totalAmount'));
    }
}