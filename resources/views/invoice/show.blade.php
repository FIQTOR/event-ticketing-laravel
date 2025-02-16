@extends('layouts.app')

@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

@section('container')
    <main class="min-h-screen px-14 py-28 flex flex-col gap-4">
        <div class="flex justify-between">
            <div class="w-1/2">
                <div class=" flex justify-between pb-10">
                    <h1 class="text-7xl font-bold text-neutral-600">INVOICE</h1>
                    <span
                        class=" flex items-center px-20 text-2xl font-bold text-white uppercase rounded-full {{ $invoice->ticket_status === 'valid' ? 'bg-green-500' : 'bg-red-500' }}">{{ $invoice->ticket_status }}</span>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex justify-between">
                        <span>INVOICE-ID</span>
                        <span class="font-semibold">{{ $invoice->invoice_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Created At</span>
                        <span>{{ $invoice->created_at }}</span>
                    </div>
                    @if ($invoice->status === 'paid')
                        <div class="flex justify-between">
                            <span>Confirmation At</span>
                            <span>{{ $invoice->updated_at }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span>Guest</span>
                        <span>{{ $invoice->payment->guest }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Layout</span>
                        <span>{{ $invoice->payment->layout }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Event Name</span>
                        <span>{{ $invoice->event->title }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Total Price</span>
                        <span
                            class="text-xl font-bold">Rp{{ number_format($invoice->payment->total_price, 2, '.', '.') }}</span>
                    </div>

                    @can('panel dashboard')
                        @if ($invoice->status === 'unpaid')
                            <form action="{{ route('invoices.confirm', $invoice->invoice_number) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button
                                    class="w-fit px-14
                                    py-2 rounded-full bg-green-500 text-white hover:opacity-70 mt-20">Confirmation
                                    This
                                    Invoice</button>
                            </form>
                        @endif
                    @endcan
                </div>
            </div>
            <div class="w-1/2 h-fit flex justify-end">
                <div class="w-fit flex flex-col items-center gap-4">
                    <div class="p-14 bg-white rounded-xl shadow-2xl flex items-center justify-center flex-col gap-7">
                        <span class="text-5xl font-bold w-full text-center">SCAN QRCODE</span>
                        {!! DNS1D::getBarcodeHTML($invoice->invoice_number, 'C39') !!}
                        <div class="flex justify-between items-center gap-4">
                            <span class="font-bold">{{ $invoice->invoice_number }}</span>
                            <button onclick="copyText('{{ $invoice->invoice_number }}')"
                                class="py-1 px-4 rounded-full bg-neutral-100 hover:opacity-70">Copy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function copyText(value) {
            copyText = value;
            // Select the text field
            // copyText.select();
            // copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText);

            alert('Berhasil di salin!');
        }
    </script>
@endsection
