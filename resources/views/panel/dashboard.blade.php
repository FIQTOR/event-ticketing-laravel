@extends('layouts.panel')

@section('container')
    <main class="w-full min-h-screen p-14">
        <h1 class="font-bold text-4xl">Dashboard</h1>
        <p class="text-xl">Welcome, {{ Auth::user()->name }} </p>

        <div class="grid grid-cols-3 py-4 gap-4">
            <a href="{{ route('users.index') }}"
                class="w-full rounded-xl p-4 shadow-xl min-h-40 relative overflow-hidden flex items-center border">
                <span class="capitalize font-bold text-2xl">TOTAL USER</span>
                <div class="absolute right-0 w-[40%] h-full bg-yellow-100 top-0 flex justify-center items-center">
                    <span class="font-bold text-4xl">{{ $usersCount }}</span>
                </div>
            </a>
            <a href="{{ route('events.index') }}"
                class="w-full rounded-xl p-4 shadow-xl min-h-40 relative overflow-hidden flex items-center border">
                <span class="capitalize font-bold text-2xl">TOTAL EVENT</span>
                <div class="absolute right-0 w-[40%] h-full bg-yellow-100 top-0 flex justify-center items-center">
                    <span class="font-bold text-4xl">{{ $eventsCount }}</span>
                </div>
            </a>
            <a href="{{ route('payments.index') }}"
                class="w-full rounded-xl p-4 shadow-xl min-h-40 relative overflow-hidden flex items-center border">
                <span class="capitalize font-bold text-2xl">TOTAL PAYMENT</span>
                <div class="absolute right-0 w-[40%] h-full bg-yellow-100 top-0 flex justify-center items-center">
                    <span class="font-bold text-4xl">{{ $paymentsCount }}</span>
                </div>
            </a>
        </div>
    </main>
@endsection
