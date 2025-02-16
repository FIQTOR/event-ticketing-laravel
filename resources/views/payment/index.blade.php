@extends('layouts.app')

@section('container')
    <main class="px-14 py-28 min-h-screen">
        <div class="flex flex-col gap-7">
            <div>
                <h1 class="font-bold text-4xl">My Payment</h1>

                <div class="pb-4">Total Payment: {{ $paymentsCount }}</div>
                <div class="grid grid-cols-3 gap-7">
                    @foreach ($payments as $payment)
                        <a href="{{ route('payments.show', $payment->payment_id) }}"
                            class="w-full p-7 rounded-xl shadow-2xl flex flex-col gap-4 relative overflow-hidden bg-yellow-50">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-xl">PAYMENT</span>
                                <span
                                    class="py-1 px-4 text-white rounded-full {{ $payment->status === 'paid' ? 'bg-green-500' : 'bg-red-500' }} uppercase">{{ $payment->status }}</span>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex justify-between">
                                    <span>Payment ID</span>
                                    <span class="font-semibold">{{ $payment->payment_id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Created at</span>
                                    <span>{{ $payment->created_at }}</span>
                                </div>
                                @if ($payment->status === 'paid')
                                    <div class="flex justify-between">
                                        <span>Confirmed at</span>
                                        <span>{{ $payment->updated_at }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between">
                                    <span>Event</span>
                                    <span>{{ $payment->event->title }}</span>
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
