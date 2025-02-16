<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::where('user_id', Auth::user()->id)->with('event')->get();
        $invoicesCount = Invoice::where('user_id', Auth::user()->id)->count();

        return view('invoice.index', [
            'title' => 'MyInvoice',
            'invoices' => $invoices,
            'invoicesCount' => $invoicesCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $event_id) {}

    /**
     * Display the specified resource.
     */
    public function show($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->with('payment')->with('event')->first();

        if (!$invoice) {
            return abort(404);
        }

        return view('invoice.show', [
            'title' => "INVOICE $invoice_number",
            'invoice' => $invoice
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
    public function update(Request $request, string $payment_id) {}


    public function scanTicket(Request $request)
    {
        $invoice = Invoice::where('invoice_number', $request->invoice_number)->with('payment')->first();
        if ($invoice->payment->status === 'unpaid') {
            return back()->with([
                'status' => 'failed',
                'message' => 'Ticket Unpaid'
            ]);
        }

        if ($invoice['ticket_status'] === 'invalid') {
            return back()->with([
                'status' => 'failed',
                'message' => 'Ticket invalid'
            ]);
        }

        $invoice['ticket_status'] = 'invalid';
        $invoice->save();

        return back()->with([
            'status' => 'success',
            'message' => 'Scan confirmed'
        ]);
    }

    public function scanTicketWithCam($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->with('payment')->first();
        if ($invoice->payment->status === 'unpaid') {
            return back()->with([
                'status' => 'failed',
                'message' => 'Ticket Unpaid'
            ]);
        }

        if ($invoice['ticket_status'] === 'invalid') {
            return back()->with([
                'status' => 'failed',
                'message' => 'Ticket invalid'
            ]);
        }

        $invoice['ticket_status'] = 'invalid';
        $invoice->save();

        return back()->with([
            'status' => 'success',
            'message' => 'Scan confirmed'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
