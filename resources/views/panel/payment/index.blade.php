@extends('layouts.panel')

@section('container')
    <main class="py-24 w-full">
        <div class=" px-7 md:px-14 relative overflow-x-auto min-h-screen">
            <h1 class="text-4xl font-bold pb-4">PAYMENT DATA</h1>
            <div class="pb-4 flex gap-4 w-max">
                <div class="flex flex-wrap items-center gap-4 m-0">
                    <div class="flex w-full items-center gap-4">
                        <label for="search">Pencarian</label>
                        <div class="flex h-full w-full md:w-fit">
                            <input type="text" name="search" id="search" placeholder="example: Payment Name"
                                onkeyup="Search(value)"
                                class='md:w-fit border border-black rounded-full px-2 py-1 focus:border-neutral-900 bg-yellow-50 text-neutral-800'>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table w-full">
                @include('partials.payments-table', compact('payments', 'currentPage', 'totalPages'))
            </div>

        </div>
        <script>
            let Url = new URL('{{ route('payments.search') }}');

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
