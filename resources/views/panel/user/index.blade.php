@extends('layouts.panel')

@section('container')
    <main class="py-24 w-full">
        <div class=" px-7 md:px-14 relative overflow-x-auto min-h-screen">
            <h1 class="text-4xl font-bold pb-4">USER DATA</h1>
            <div class="pb-4 flex gap-4 w-max">
                <div class="flex flex-wrap items-center gap-4 m-0">
                    <a href="{{ route('users.create') }}"
                        class="px-7 py-2 bg-blue-500 hover:opacity-70 rounded-full text-white">Create New</a>
                    <div class="flex">
                        <button onclick="HandleRole('admin')"
                            class="px-7 py-2 bg-blue-600 hover:opacity-70 rounded-l-full text-white">Only Admin</button>
                        <button onclick="HandleRole('user')" class="px-7 py-2 bg-blue-400 hover:opacity-70 text-white">Only
                            User</button>
                        <button onclick="HandleRole('all')"
                            class="px-7 py-2 bg-blue-300 hover:opacity-70 rounded-r-full text-white">All Role</button>
                    </div>
                    <div class="flex w-full items-center gap-4">
                        <label for="search">Pencarian</label>
                        <div class="flex h-full w-full md:w-fit">
                            <input type="text" name="search" id="search" placeholder="example: Event Name"
                                onkeyup="Search(value)"
                                class='md:w-fit border border-black rounded-full px-2 py-1 bg-yellow-50 focus:border-neutral-900 text-neutral-800'>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table w-full">
                @include('partials.users-table', compact('users', 'currentPage', 'totalPages'))
            </div>

            <script>
                let Url = new URL('{{ route('users.search') }}');

                function Search(keyword) {
                    Url.searchParams.set('search', keyword);

                    $.ajax({
                        type: 'get',
                        url: Url,

                        success: (res) => {
                            $('.table').html(res)
                            // SyncUrl()
                        }
                    });
                }

                function HandleOrderBy(e, orderBy, orderIn) {
                    e.preventDefault()
                    Url.searchParams.set('orderBy', orderBy);
                    Url.searchParams.set('orderIn', orderIn);

                    $.ajax({
                        type: 'get',
                        url: Url,

                        success: (res) => {
                            $('.table').html(res)
                            // SyncUrl()
                        }
                    });
                }

                function HandlePage(page) {
                    Url.searchParams.set('page', page);

                    $.ajax({
                        type: 'get',
                        url: Url,

                        success: (res) => {
                            $('.table').html(res)
                            // SyncUrl()
                        }
                    });
                }

                function HandleRole(role) {
                    Url.searchParams.set('role', role);

                    $.ajax({
                        type: 'get',
                        url: Url,

                        success: (res) => {
                            $('.table').html(res)
                            // SyncUrl()
                        }
                    });
                }

                function HandleDeleteSelected(e) {
                    e.preventDefault()
                    if (confirm('Are you sure you want to delete the selected users?')) {
                        var selectedUuids = [];
                        document.querySelectorAll('input[name="user_ids[]"]:checked').forEach(function(checkbox) {
                            selectedUuids.push(checkbox.value);
                        });

                        if (selectedUuids.length > 0) {
                            $.ajax({
                                url: '{{ route('users.deleteSelected') }}',
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    _method: 'DELETE',
                                    user_ids: selectedUuids
                                },
                                success: function(res) {
                                    // Optionally, refresh the page or remove deleted rows from the table
                                    location.reload();
                                },
                                error: function(res) {
                                    // Handle error response
                                    alert('An error occurred while deleting users.');
                                }
                            });
                        } else {
                            alert('Please select at least one user to delete.');
                        }
                    }
                }

                function SyncUrl() {
                    var baseUrl = new URL(window.location.href);
                    // Salin parameter yang ada kecuali parameter yang ingin dihapus
                    Url.searchParams.forEach((value, key) => {
                        baseUrl.searchParams.set(key, value);
                    });

                    history.pushState({}, '', baseUrl.toString());
                }
            </script>
        </div>
    </main>
@endsection
