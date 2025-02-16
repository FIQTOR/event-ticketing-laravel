@extends('layouts.panel')

@section('container')
    <main class="py-24 px-7">
        <form action="{{ route('users.update.password', $user->id) }}" method="POST" class="flex flex-col gap-4">
            @csrf

            <div>
                <h1 class="text-2xl font-bold">Reset User Password</h1>
                <p class="text-neutral-700">You can reset a user password</p>
            </div>

            @if (session()->has('message'))
                <p class="{{ session('status') === 'success' ? 'text-green-400' : 'text-red-400' }}">
                    {{ session('message') }}
                </p>
            @endif

            <div class="flex flex-col gap-2">
                <label for="password">Password</label>
                <div class="flex flex-col">
                    <input type="password" name="password" id="password" required placeholder=""
                        class="w-full px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                    @error('password')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password_confirm">Repeat Password</label>
                <div class="flex flex-col">
                    <input type="password" name="password_confirm" id="password_confirm" required placeholder=""
                        class="w-full px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                    @error('password_confirm')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="text-white flex gap-4 w-full">
                <a href="{{ route('users.edit', $user->uuid) }}"
                    class="w-full px-4 py-2 text-center bg-red-500 rounded-full hover:opacity-70">Cancel</a>
                <button class="w-full px-4 py-2 text-center bg-blue-500 rounded-full hover:opacity-70">Reset</button>
            </div>
        </form>
    </main>
@endsection
