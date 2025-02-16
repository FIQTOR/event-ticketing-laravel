@extends('layouts.panel')

@section('container')
    <main class="py-24 px-7 md:px-14">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col md:flex-row gap-14">
            @csrf
            <div class="flex flex-col gap-4 md:w-full">

                <div>
                    <h1 class="text-2xl font-bold">Create New User</h1>
                    <p class="text-neutral-700">You can create new user for buyer, staff, or admin</p>
                </div>

                @if (session()->has('message'))
                    <p class="{{ session('status') === 'success' ? 'text-green-400' : 'text-red-400' }}">
                        {{ session('message') }}
                    </p>
                @endif

                <div class="flex flex-col gap-2">
                    <label for="name">Display Name</label>
                    <div class="flex flex-col">
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            placeholder="example: John nathan"
                            class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                        @error('name')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="email">Email Address</label>
                    <div class="flex flex-col">
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            placeholder="example: john123@example.com"
                            class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                        @error('email')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="flex w-full flex-col gap-2">
                        <label for="password">Password</label>
                        <div class="flex flex-col">
                            <input type="password" name="password" id="password" required placeholder=""
                                class="w-full px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                            @error('password')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex w-full flex-col gap-2">
                        <label for="password_confirm">Repeat Password</label>
                        <div class="flex flex-col">
                            <input type="password" name="password_confirm" id="password_confirm" required placeholder=""
                                class="w-full px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                            @error('password_confirm')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="position">Position</label>
                    <select name="position" id="position"
                        class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                        <option value="user">User</option>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="text-white flex gap-4 w-full">
                    <a href="{{ route('users.index') }}"
                        class="w-full px-4 py-2 text-center bg-red-500 rounded-full hover:opacity-70">Cancel</a>
                    <button class="w-full px-4 py-2 text-center bg-blue-500 rounded-full hover:opacity-70">Create</button>
                </div>
            </div>
        </form>
    </main>

    <script>
        document.getElementById('profile_picture').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('preview_profile_picture');
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
