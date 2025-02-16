@extends('layouts.panel')

@section('container')
    <main class="px-14 py-28">
        <h1 class="text-4xl font-bold">INVOICE FINDER</h1>

        <form action="{{ route('payment.finder') }}" method="POST" class="flex flex-col gap-4">
            @csrf

            @if (session()->has('message'))
                <p class="{{ session('status') === 'success' ? 'text-green-400' : 'text-red-400' }}">
                    {{ session('message') }}
                </p>
            @endif

            <div class="flex flex-col gap-2 pt-7">
                <label for="payment_id">PAYMENT ID</label>
                <div class="flex flex-col">
                    <input type="text" name="payment_id" id="payment_id" placeholder="example: PAY-XXXXXXXX" required
                        value="{{ old('payment_id') }}"
                        class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                    @error('payment_id')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button class="w-full py-2 max-w-sm rounded-full bg-neutral-700 text-white hover:opacity-70">Find</button>
        </form>
    </main>
@endsection
