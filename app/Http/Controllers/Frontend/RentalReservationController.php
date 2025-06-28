<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RentalNoticeBoardAccommodation;

use App\Models\RentalReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentalReservationController extends Controller
{
    public function showCheckout($id)
    {
        $rentalNotice = RentalNoticeBoardAccommodation::with('user')->findOrFail($id);

        // Check if property is still available
        if ($rentalNotice->status !== 'active') {
            return redirect()->back()->with('error', 'This property is no longer available for reservation.');
        }

        // Check if user already has a pending reservation for this property
        $existingReservation = RentalReservation::where('rental_notice_id', $id)
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'confirmed'])
            ->first();

        // if ($existingReservation) {
        //     return redirect()->back()->with('error', 'You already have a reservation for this property.');
        // }

        return view('frontend.rental.checkout', compact('rentalNotice'));
    }

    public function processReservation(Request $request, $id)
    {
        $rentalNotice = RentalNoticeBoardAccommodation::findOrFail($id);

        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'address' => 'required|string|max:500',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'order_notes' => 'nullable|string|max:1000',
            'payment_method' => 'required|in:card,bkash',
        ]);

        // Calculate reservation fee (e.g., 10% of monthly rent or a fixed amount)
        $reservationFee = $rentalNotice->advance_amount;

        try {
            DB::beginTransaction();

            // Create reservation record
            $reservation = RentalReservation::create([
                'rental_notice_id' => $id,
                'user_id' => Auth::id(),
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'company_name' => $validated['company_name'],
                'address' => $validated['address'],
                'country' => $validated['country'],
                'city' => $validated['city'],
                'zip_code' => $validated['zip_code'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'order_notes' => $validated['order_notes'],
                'payment_method' => $validated['payment_method'],
                'reservation_fee' => $reservationFee,
                'status' => 'pending',
                'reservation_code' => 'RES-' . strtoupper(uniqid()),
            ]);

            DB::commit();

            // $type = "reservation";
            // Redirect to payment gateway based on selected method
            if ($validated['payment_method'] === 'card') {

                return redirect()->route('rental.payment.card', $reservation->id);
            } else {
                return redirect()->route('rental.payment.bkash', $reservation->id);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function showCardPayment($reservationId)
    {
        $reservation = RentalReservation::with('rentalNotice')->findOrFail($reservationId);
        $type = "reservation";

        // Check if reservation belongs to authenticated user
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('frontend.payment.card', compact('reservation', 'type'));
    }

    public function processCardPayment(Request $request, $reservationId)
    {
        $reservation = RentalReservation::findOrFail($reservationId);

        $validated = $request->validate([
            'card_number' => 'required|string', // Including spaces
            'card_holder_name' => 'required|string|max:255',
            'expiry_date' => 'required|string', // MM/YY format
            'cvv' => 'required|string',
        ]);

        // Simulate payment processing (in real scenario, integrate with payment gateway)
        try {
            DB::beginTransaction();

            // Update reservation status
            $reservation->update([
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'payment_details' => json_encode([
                    'method' => 'card',
                    'card_last_four' => substr(str_replace(' ', '', $validated['card_number']), -4),
                    'card_holder' => $validated['card_holder_name'],
                    'transaction_id' => 'TXN-' . strtoupper(uniqid()),
                    'processed_at' => now(),
                ]),
            ]);

            // Update rental notice status if needed
            $rentalNotice = $reservation->rentalNotice;
            $rentalNotice->update(['status' => 'rented']);

            DB::commit();

            return redirect()->route('rental.reservation.success', $reservation->id)
                ->with('success', 'Payment successful! Your reservation has been confirmed.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Payment failed. Please try again.');
        }
    }

    public function showBkashPayment($reservationId)
    {
        // return
        $reservation = RentalReservation::with('rentalNotice')->findOrFail($reservationId);
        $type = "reservation";

        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('frontend.payment.bkash', compact('reservation', 'type'));
    }

    public function processBkashPayment(Request $request, $reservationId)
    {
        $reservation = RentalReservation::findOrFail($reservationId);

        $validated = $request->validate([
            'bkash_number' => 'required|string|max:15',
            'bkash_pin' => 'required|string|min:4|max:6',
        ]);

        try {
            DB::beginTransaction();

            // Simulate bKash payment processing
            $reservation->update([
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'payment_details' => json_encode([
                    'method' => 'bkash',
                    'bkash_number' => $validated['bkash_number'],
                    'transaction_id' => 'BKS-' . strtoupper(uniqid()),
                    'processed_at' => now(),
                ]),
            ]);

            $rentalNotice = $reservation->rentalNotice;
            $rentalNotice->update(['status' => 'rented']);

            DB::commit();

            return redirect()->route('rental.reservation.success', $reservation->id)
                ->with('success', 'bKash payment successful! Your reservation has been confirmed.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Payment failed. Please try again.');
        }
    }

    public function showSuccess($reservationId)
    {
        // return
        $reservation = RentalReservation::with('rentalNotice')->findOrFail($reservationId);

        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('frontend.rental.success', compact('reservation'));
        // return redirect()->route('rental-notice.index')->with('success', 'Reservation successful! Your reservation has been confirmed.');
    }

    public function userReservations()
    {
        $reservations = RentalReservation::with(['rentalNotice', 'rentalNotice.images'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.user.reservations', compact('reservations'));
    }
}
