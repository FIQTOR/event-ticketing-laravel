@extends('layouts.app')

@section('container')
    <main class="px-14 py-28 min-h-screen">
        <div class="flex flex-col gap-7">
            <div>
                <h1 class="font-bold text-4xl">My Invoice</h1>

                <div class="pb-4">Total Invoice: {{ $invoicesCount }}</div>
                <div class="grid grid-cols-3 gap-7">
                    @foreach ($invoices as $invoice)
                        <a href="{{ route('invoice.show', $invoice->invoice_number) }}"
                            class="w-full p-7 rounded-xl shadow-2xl flex flex-col gap-4 relative overflow-hidden bg-yellow-50">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-xl">INVOICE</span>
                                <span
                                    class="py-1 px-4 text-white rounded-full {{ $invoice->ticket_status === 'valid' ? 'bg-green-500' : 'bg-red-500' }} uppercase">{{ $invoice->ticket_status }}</span>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex justify-between">
                                    <span>Invoice Number</span>
                                    <span class="font-semibold">{{ $invoice->invoice_number }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Created at</span>
                                    <span>{{ $invoice->created_at }}</span>
                                </div>
                                @if ($invoice->status === 'paid')
                                    <div class="flex justify-between">
                                        <span>Confirmed at</span>
                                        <span>{{ $invoice->updated_at }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between">
                                    <span>Event</span>
                                    <span>{{ $invoice->event->title }}</span>
                                </div>
                            </div>
                            <div class="absolute w-full h-4 bg-yellow-100 left-0 top-0"></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
