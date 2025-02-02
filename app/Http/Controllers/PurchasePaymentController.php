<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Purchase;
use App\Models\PurchasePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\App;

class PurchasePaymentController extends Controller
{
    /**
     * Show the payment details and payment status for a purchase.
     *
     * @param  int  $purchaseId
     * @return \Illuminate\Http\Response
     * 
     */


    public function showPayments($purchaseId)
    {
        // Fetch the purchase along with its associated payments
        $purchase = Purchase::with('payments')->findOrFail($purchaseId);

        // Ensure all payments' payment_date is cast to Carbon instance
        foreach ($purchase->payments as $payment) {
            $payment->payment_date = Carbon::parse($payment->payment_date); // Ensure it's a Carbon instance
        }

        return view('admin.purchases.index', compact('purchase'));
    }


    public function showPaymentForm(Request $request)
    {
        $purchaseId = $request->purchaseId;
        // Fetch the purchase and its associated payments
        $purchase = Purchase::with('payments')->findOrFail($purchaseId);

        // Calculate the total amount already paid
        $totalPaid = $purchase->payments->sum('amount');


        // Calculate the remaining amount to pay
        $remainingAmount = $purchase->amount_to_pay - $totalPaid;


        // Return the view with the necessary data
        return view('admin.purchases.payment_form', compact('purchase', 'remainingAmount'));
    }

    /**
     * Store the payment and update the purchase status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $purchaseId
     * @return \Illuminate\Http\Response
     */
    public function storePayment(Request $request, $purchaseId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string',
            'transaction_reference' => 'nullable|string',
            "payment_date" => "nullable|date"
        ]);

        // Fetch the purchase
        $purchase = Purchase::findOrFail($purchaseId);
        // Calculate the total amount already paid
        $totalPaid = $purchase->payments->sum('amount');
        $newPaymentAmount = $request->input('amount');

        // Ensure the total amount paid does not exceed the amount to pay
        if ($totalPaid + $newPaymentAmount > $purchase->amount_to_pay) {
            return back()->withErrors(['amount' => 'Payment exceeds the remaining amount to pay.']);
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Store the new payment
            $payment = new PurchasePayment([
                'purchase_id' => $purchase->id,
                'amount' => $newPaymentAmount,
                'payment_method' => $request->input('payment_method'),
                'transaction_reference' => $request->input('transaction_reference'),
                'payment_date' => $request->input('payment_date') ?? now(),
            ]);
            $payment->save();

            // Update the purchase payment status without modifying the amount_to_pay
            $totalPaid = $purchase->payments->sum('amount') + $newPaymentAmount;
            $purchase->payment_status = $this->determinePaymentStatus($purchase->amount_to_pay, $totalPaid);
            $purchase->save();

            // Commit the transaction
            DB::commit();
            Alert::success('Payment stored Successfully!', 'You have stored the payment.');
            return redirect()->route('purchases.index', ['lang' => App::getLocale()]);
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred while processing the payment.']);
        }
    }


    /**
     * Determine the payment status of the purchase.
     *
     * @param  float  $amountToPay
     * @param  float  $totalPaid
     * @return string
     */
    protected function determinePaymentStatus($amountToPay, $totalPaid)
    {
        if ($totalPaid == 0) {
            return 'unpaid';
        } elseif ($totalPaid < $amountToPay) {
            return 'partial';
        } else {
            return 'paid';
        }
    }




    // Method to print payments for a specific purchase
    public function printPayments($purchase_id)
    {
        $purchase = Purchase::with('payments')->findOrFail($purchase_id);

        // Calculate the sum of payments
        $totalPayments = $purchase->payments->sum('amount');

        // Calculate if the total amount has been paid or remaining
        $isPaid = $purchase->amount_to_pay <= $totalPayments;

        // Prepare data to pass to the PDF
        $data = [
            'purchase' => $purchase,
            'totalPayments' => $totalPayments,
            'isPaid' => $isPaid,
        ];

        // Generate PDF using the view
        $pdf = PDF::loadView('admin.purchases.print_payments', $data);

        // Return the PDF for download or stream
        return $pdf->download("purchase_{$purchase->id}_payments.pdf");
    }
}
