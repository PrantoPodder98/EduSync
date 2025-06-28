<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RentOrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Illuminate\Http\Request;

class RentOrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'address' => 'required|string|max:500',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'order_notes' => 'nullable|string|max:1000'
        ]);

        $user = Auth::user();
        $cartItems = $user->rentCartWithItems()->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('rent.cart.index')->with('error', 'Your cart is empty!');
        }

        // Since only 1 product is allowed, get the first item
        $cartItem = $cartItems->first();
        $paymentOption = $cartItem->rentItem->user_payment_option;

        // Store order data in session for payment processing
        // return $request->all();
        session([
            'pending_order' => $request->all(),
            'rent_cart_items' => $cartItems
        ]);

        // Redirect to bKash payment
        if ($cartItem->rentItem->rent_duration != 0) {
            $amount = $cartItem->rentItem->price * $cartItem->rentItem->rent_duration;
        } else {
            $amount = $cartItem->rentItem->price;
        }
        // Check payment option
        if (strtolower($paymentOption) === 'cash on delivery') {
            return $this->processOrder($request, $cartItems, $amount);
        } else {
            // return $amount;
            return redirect()->route('rent.payment.bkash', ['amount' => $amount, 'bkash_number' => $cartItem->rentItem->user_bKash_number, 'type' => 'rent']);
        }
    }

    private function processOrder($request, $cartItems, $amount)
    {
        $user = Auth::user();

        DB::beginTransaction();
        try {
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
                'city' => $request->city,
                'zip_code' => $request->zip_code,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'total_amount' => $totalAmount,
                'order_notes' => $request->order_notes,
                'payment_method' => $cartItems->first()->rentItem->user_payment_option,
                'payment_status' => strtolower($cartItems->first()->rentItem->user_payment_option) === 'cash on delivery' ? 'pending' : 'completed',
                'status' => 'pending'
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                RentOrderItem::create([
                    'order_id' => $order->id,
                    'rent_item_id' => $cartItem->rent_item_id,
                    'price' => $amount,
                ]);
                $cartItem->rentItem->update(['status' => 0]); // 0 = sold
            }

            // Clear the cart
            $user->rentCartItems()->delete();

            // Clear session data
            session()->forget(['pending_order', 'rent_cart_items']);

            DB::commit();

            // return redirect()->route('rent.order.success', $order->id)->with('success', 'Order placed successfully!');
            return redirect()->route('orders.index')->with('success', 'Order placed successfully! Your order number is ' . $order->order_number);
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

        return redirect()->route('rent.orders.index')->with('success', 'Order placed successfully! Your order number is ' . $order->order_number);
    }

    /**
     * Show user's orders
     */
    public function myOrders()
    {
        $orders = Auth::user()->orders()->with('orderItems.rentItem.images')
            ->latest()
            ->paginate(10);

        return view('frontend.orders.rent.index', compact('orders'));
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

        $order->load('orderItems.rentItem.images');

        return view('frontend.orders.rent.show', compact('order'));
    }
}
