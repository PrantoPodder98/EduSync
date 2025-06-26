<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SecondHandProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Show bKash payment page
     */
    public function showBkashPayment(Request $request)
    {
        $amount = $request->get('amount');
        
        if (!session('pending_order') || !session('cart_items')) {
            return redirect()->route('cart.index')->with('error', 'Invalid payment session!');
        }

        return view('frontend.payment.bkash', compact('amount'));
    }

    /**
     * Process bKash payment
     */
    public function processBkashPayment(Request $request)
    {
        $request->validate([
            'bkash_number' => 'required|string|max:15',
            'bkash_pin' => 'required|string|min:4|max:6',
        ]);

        $pendingOrder = session('pending_order');
        $cartItems = session('cart_items');

        if (!$pendingOrder || !$cartItems) {
            return redirect()->route('cart.index')->with('error', 'Payment session expired!');
        }

        // Simulate bKash payment processing
        $paymentSuccess = $this->simulateBkashPayment($request->bkash_number, $request->bkash_pin);

        if ($paymentSuccess) {
            // Process the order after successful payment
            $orderRequest = new Request($pendingOrder);
            $cartItemsCollection = collect($cartItems);
            
            return $this->processOrderAfterPayment($orderRequest, $cartItemsCollection, $request->bkash_number);
        } else {
            return redirect()->back()->with('error', 'Payment failed! Please check your bKash credentials and try again.');
        }
    }

    /**
     * Simulate bKash payment (dummy implementation)
     */
    private function simulateBkashPayment($bkashNumber, $pin)
    {
        // Dummy validation - in real implementation, this would call bKash API
        // For demo purposes, accept any 11-digit number starting with 01 and any 4+ digit PIN
        if (preg_match('/^01[3-9]\d{8}$/', $bkashNumber) && strlen($pin) >= 4) {
            // Simulate processing delay
            sleep(2);
            return true;
        }
        return false;
    }

    /**
     * Process order after successful payment
     */
    private function processOrderAfterPayment($request, $cartItems, $bkashNumber)
    {
        $user = Auth::user();
        
        DB::beginTransaction();
        try {
            $totalAmount = $cartItems->sum(function($item) {
                return $item['secondHandProduct']['price'];
            });

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
                'payment_method' => 'bKash',
                'payment_status' => 'completed',
                'bkash_number' => $bkashNumber,
                'status' => 'pending'
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'second_hand_product_id' => $cartItem['second_hand_product_id'],
                    'price' => $cartItem['secondHandProduct']['price']
                ]);
                $cartItem->secondHandProduct->update(['status' => 0]); // 0 = sold
            }

            // Clear the cart
            $user->cartItems()->delete();

            // Clear session data
            session()->forget(['pending_order', 'cart_items']);

            DB::commit();

            // return redirect()->route('order.success', $order->id)->with('success', 'Order placed successfully!');
            return redirect()->route('orders.index')->with('success', 'Payment successful! Order placed successfully! Your order number is ' . $order->order_number);


        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('cart.index')->with('error', 'Order processing failed after payment. Please contact support.');
        }
    }
}