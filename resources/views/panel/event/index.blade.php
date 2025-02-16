@extends('layouts.panel')

@section('container')
    <main class="py-24 w-full">
        <div class=" px-7 md:px-14 relative overflow-x-auto min-h-screen">
            <h1 class="text-4xl font-bold pb-4">EVENT DATA</h1>
            <div class="pb-4 flex gap-4 w-max">
                <div class="flex flex-wrap items-center gap-4 m-0">
                    <a href="{{ route('events.create') }}"
                        class="px-7 py-2 bg-blue-500 hover:opacity-70 rounded-full text-white">Create New</a>
                    <div class="flex w-full items-center gap-4">
                        <label for="search">Pencarian</label>
                        <div class="flex h-full w-full md:w-fit">
                            <input type="text" name="search" id="search" placeholder="example: Event Name"
                                onkeyup="Search(value)"
                                class='md:w-fit border border-black rounded-full px-2 py-1 focus:border-neutral-900 bg-yellow-50 text-neutral-800'>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table w-full">
                @include('partials.events-table', compact('events', 'currentPage', 'totalPages'))
            </div>

        </div>
        <script>
            let Url = new URL('{{ route('events.search') }}');

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

            function HandleDeleteSelected(e) {
                e.preventDefault()
                if (confirm('Are you sure you want to delete the selected events?')) {
                    var selectedUuids = [];
                    document.querySelectorAll('input[name="event_ids[]"]:checked').forEach(function(checkbox) {
                        selectedUuids.push(checkbox.value);
                    });

                    if (selectedUuids.length > 0) {
                        $.ajax({
                            url: '{{ route('events.deleteSelected') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE',
                                event_ids: selectedUuids
                            },
                            success: function(res) {
                                // Optionally, refresh the page or remove deleted rows from the table
                                location.reload();
                            },
                            error: function(res) {
                                // Handle error response
                                alert('An error occurred while deleting events.');
                            }
                        });
                    } else {
                        alert('Please select at least one events to delete.');
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
    </main>
@endsection
