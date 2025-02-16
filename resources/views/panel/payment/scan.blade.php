@extends('layouts.panel')

@section('container')
    <main class="px-14 py-28">
        <h1 class="text-4xl font-bold">SCAN TICKET</h1>

        <form action="{{ route('invoice.scan.post') }}" method="POST" class="flex flex-col gap-4">
            @csrf

            @if (session()->has('message'))
                <p class="{{ session('status') === 'success' ? 'text-green-400' : 'text-red-400' }}">
                    {{ session('message') }}
                </p>
            @endif

            <div class="flex flex-col gap-2">
                <label for="invoice_number">Invoice Number</label>
                <div class="flex flex-col">
                    <input type="text" name="invoice_number" id="invoice_number" placeholder="example: XXXXXXXX" required
                        value="{{ old('invoice_number') }}"
                        class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900" autofocus>
                    @error('invoice_number')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- <button class="w-full py-2 max-w-sm rounded-full bg-neutral-700 text-white hover:opacity-70">SCAN
                TICKET</button> --}}
        </form>
    </main>
@endsection
