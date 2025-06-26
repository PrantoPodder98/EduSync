<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Process the order
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'address' => 'required|string|max:500',
            'country' => 'required|string|max:100',
            'region_state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'order_notes' => 'nullable|string|max:1000'
        ]);

        $user = Auth::user();
        $cartItems = $user->cartWithProducts()->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();

        try {
            // Calculate total amount
            $totalAmount = $cartItems->sum('total_price');

            // Create order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_name' => $request->company_name,
                'address' => $request->address,
                'country' => $request->country,
                'region_state' => $request->region_state,
                'city' => $request->city,
                'zip_code' => $request->zip_code,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'total_amount' => $totalAmount,
                'order_notes' => $request->order_notes,
                'status' => 'pending'
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'second_hand_product_id' => $cartItem->second_hand_product_id,
                    'price' => $cartItem->secondHandProduct->price
                ]);
            }

            // Clear the cart
            $user->cartItems()->delete();

            DB::commit();

            return redirect()->route('order.success', $order->id)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }

    /**
     * Show order success page
     */
    public function orderSuccess(Order $order)
    {
        // Check if order belongs to authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.secondHandProduct.images');

        return view('frontend.orders.success', compact('order'));
    }

    /**
     * Show user's orders
     */
    public function myOrders()
    {
        $orders = Auth::user()->orders()->with('orderItems.secondHandProduct.images')
            ->latest()
            ->paginate(10);

        return view('frontend.orders.index', compact('orders'));
    }

    /**
     * Show order details
     */
    public function show(Order $order)
    {
        // Check if order belongs to authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.secondHandProduct.images');

        return view('frontend.orders.show', compact('order'));
    }
}