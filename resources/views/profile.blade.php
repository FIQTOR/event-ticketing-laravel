@extends('layouts.app')

@section('container')
    <main class="w-full h-screen py-28 px-14">
        <h1 class="font-bold text-4xl">My Profile</h1>

        <form action="#" method="POST" class="w-full max-w-sm flex flex-col gap-4 py-4">

            <div class="flex flex-col gap-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="px-4 py-2 rounded-full border"
                    value="{{ Auth::user()->name }}">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="email">Email Address</label>
                <input readonly type="email" name="email" id="email" class="px-4 py-2 rounded-full border"
                    value="{{ Auth::user()->email }}">
                @error('email')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <button class="w-full py-2 rounded-full bg-yellow-100">Update</button>
        </form>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            @method('DELETE')

            <button class="text-red-400 hover:opacity-70">Logout</button>
        </form>
    </main>
@endsection
