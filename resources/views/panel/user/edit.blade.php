@extends('layouts.panel')

@section('container')
    <main class="py-24 px-7 md:px-14">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="flex gap-4 md:gap-14 flex-col md:flex-row">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-4 w-full md:w-full">
                <div>
                    <h1 class="text-2xl font-bold">Edit User</h1>
                    <p class="text-neutral-700">You can update user buyer, staff, or admin</p>
                </div>

                @if (session()->has('message'))
                    <p class="{{ session('status') === 'success' ? 'text-green-400' : 'text-red-400' }}">
                        {{ session('message') }}
                    </p>
                @endif

                <div class="flex flex-col gap-2">
                    <label for="name">Display Name</label>
                    <div class="flex flex-col">
                        <input type="text" name="name" id="name" required value="{{ $user->name }}"
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
                        <input type="email" name="email" id="email" required value="{{ $user->email }}"
                            placeholder="example: john123@example.com"
                            class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                        @error('email')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @isset($user->google_id)
                    <div class="flex flex-col">
                        <div class="text-neutral-400">(sync with google)</div>
                        <div class="text-neutral-400">Reset Password</div>
                    </div>
                @else
                    <a href="{{ route('edit-password', $user->id) }}" class="text-blue-400 hover:opacity-70">Reset
                        Password</a>
                @endisset

                <div class="flex flex-col gap-2">
                    <label for="position">Position</label>
                    <select name="position" id="position"
                        class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                        <option value="user">User</option>
                        <option value="staff" @if ($user->hasRole('staff')) selected @endif>Staff</option>
                        <option value="admin" @if ($user->hasRole('admin')) selected @endif>Admin</option>
                    </select>
                </div>

                <div class="text-white flex gap-4 w-full">
                    <a href="{{ route('users.index') }}"
                        class="w-full px-4 py-2 text-center bg-red-500 rounded-full hover:opacity-70">Cancel</a>
                    <button class="w-full px-4 py-2 text-center bg-blue-500 rounded-full hover:opacity-70">Update</button>
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
