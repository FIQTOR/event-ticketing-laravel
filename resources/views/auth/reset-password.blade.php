@extends('layouts.app')

@section('container')
    {{-- Start Generation Here --}}
    <div class="w-full min-h-screen pt-24 px-14">
        <h1 class="text-4xl font-bold">Reset Password</h1>
        <form action="{{ route('reset-password.put') }}" method="POST" class="flex w-full max-w-xl flex-col gap-4">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-2">
                <label for="password">New Password</label>
                <input type="password" name="password" id="password" class="px-4 py-2 rounded-full border text-black"
                    required>
                @error('password')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-2">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" name="password_confirm" id="password_confirm"
                    class="px-4 py-2 rounded-full border text-black" required>
                @error('password_confirm')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <button class="w-full py-2 rounded-full bg-yellow-100">Reset Password</button>
        </form>
    </div>
    {{-- End Generation Here --}}
@endsection
