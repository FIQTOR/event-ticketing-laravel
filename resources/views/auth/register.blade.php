@extends('layouts.app')

@section('container')
    <main class="w-full h-screen flex items-center justify-center text-white">

        <div class="fixed top-0 left-0 w-full h-screen -z-10">
            <img src="{{ asset('assets/img/background.jpg') }}" alt="background">
        </div>

        <div class="w-full max-w-sm p-7 rounded-xl shadow-2xl">
            <h1 class="font-sans text-4xl">REGISTER</h1>

            <form action="#" method="POST" class="flex flex-col gap-4">

                @if (session()->has('message'))
                    <p class="{{ session('status') === 'success' ? 'text-green-400' : 'text-red-400' }}">
                        {{ session('message') }}
                    </p>
                @endif

                @csrf

                <div class="flex flex-col gap-2">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="px-4 py-2 rounded-full border">
                    @error('name')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="px-4 py-2 rounded-full border">
                    @error('email')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="px-4 py-2 rounded-full border">
                    @error('password')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password_confirm">Repeat Password</label>
                    <input type="password" name="password_confirm" id="password_confirm"
                        class="px-4 py-2 rounded-full border">
                    @error('password_confirm')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <button class="w-full py-2 rounded-full bg-white text-black duration-300 hover:opacity-70">Daftar</button>
            </form>

            <p>
                Sudah mempunyai akun?
                <a href="{{ route('login') }}" class="text-blue-300 hover:opacity-70">Login</a>
            </p>
        </div>
    </main>
@endsection
