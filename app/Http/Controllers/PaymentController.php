<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getPaymentDetails($enrollment_id)
    {
        // Fetch the payment by enrollment_id
        $payment = Payment::where('enrollment_id', $enrollment_id)->first();

        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        return response()->json([
            'sender_number' => $payment->sender_number,
            'sender_name' => $payment->sender_name,
            'amount' => $payment->amount,
            'ref_no' => $payment->ref_no,
            'screenshot' => $payment->screenshot,
        ]);
    }
}
