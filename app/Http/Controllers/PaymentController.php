<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $payments = Payment::latest()->paginate(15);
        $title = 'Event Data';
        $paymentsCount = Payment::count();
        $currentPage = $payments->currentPage();
        $totalPages = $payments->lastPage();
        $orderIn = 'created_at';
        $orderBy = 'desc';
        return view('panel.payment.index', compact('title', 'payments', 'paymentsCount', 'currentPage', 'totalPages', 'orderBy', 'orderIn'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $event_id)
    {
        $request->validate([
            'guest' => 'required|min:0',
            'layout' => 'required'
        ]);

        $event = Event::find($event_id);

        if (!$event) {
            return abort(404);
        }

        $total_price = $event->price * $request->guest;
        $payment_id = 'PAY-' . strtoupper(Str::random(10));

        $newPayment = new Payment([
            'user_id' => Auth::user()->id,
            'event_id' => $request->event_id,
            'payment_id' => $payment_id,
            'total_price' => $total_price,
            'guest' => $request->guest,
            'layout' => $request->layout,
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $total_price,
            ),
            'customer_details' => array(
                'frist_name' => Auth::user()->name,
                'email' => Auth::user()->email
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $newPayment->snap_token = $snapToken;
        $newPayment->save();

        return redirect()->to(route('payments.show', $payment_id));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $payment = Payment::where('payment_id', $id)->with('event')->first();

        if (!$payment) {
            return abort(404);
        }

        return view('payment.show', [
            'title' => "Payment $id",
            'payment' => $payment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $payment_id, $status, $order_id)
    {
        $payment = Payment::where('payment_id', $payment_id)->first();

        if (!$payment) {
            return abort(404);
        }

        $payment['status'] = 'paid';
        $payment->save();

        $invoice_number = random_int(1000000000, 9999999999);

        $newInvoice = new Invoice([
            'user_id' => $payment->user_id,
            'event_id' => $payment->event_id,
            'payment_id' => $payment->id,
            'invoice_number' => $invoice_number,
            'ticket_status' => 'valid',
        ]);
        $newInvoice->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Successful confirm payment',
            'redirectUrl' => route('invoice.show', $invoice_number)
        ]);
    }

    public function paymentFinder(Request $request)
    {
        $payment = Payment::where('payment_id', $request->payment_id)->first();

        if (!$payment) {
            return back()->with([
                'status' => 'failed',
                'message' => 'Payment ID invalid!'
            ]);
        }
        return redirect()->to(route('payments.show', $request->payment_id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $orderIn = $request->query('orderIn') ? $request->query('orderIn') : 'created_at';
        $orderBy = $request->query('orderBy') ? $request->query('orderBy') : 'desc';
        $search = $request->query('search') ? $request->query('search') : '';

        // Query dasar untuk pengguna dengan kriteria pencarian
        $query = Payment::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('payment_id', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('total_price', 'like', '%' . $search . '%')
                    ->orWhere('guest', 'like', '%' . $search . '%')
                    ->orWhere('layout', 'like', '%' . $search . '%');
            });
        });

        // Hitung total pengguna yang sesuai dengan kriteria pencarian
        $paymentsCount = $query->count();
        // Dapatkan pengguna dengan pagination
        $payments = $query->orderBy($orderIn, $orderBy)->paginate(15);
        $currentPage = $payments->currentPage();
        $totalPages = $payments->lastPage();
        return view('partials.payments-table', compact('payments', 'paymentsCount', 'currentPage', 'totalPages', 'orderBy', 'orderIn'));
    }

    public function myPayment()
    {
        $payments = Payment::where('user_id', Auth::user()->id)->with('invoice')->with('event')->get();
        $paymentsCount = Payment::where('user_id', Auth::user()->id)->count();

        return view('payment.index', [
            'title' => 'My Payment',
            'payments' => $payments,
            'paymentsCount' => $paymentsCount
        ]);
    }
}
