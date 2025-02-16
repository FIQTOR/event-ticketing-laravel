@extends('layouts.app')

@section('container')
    <header class="w-full h-screen">
        <section class="w-full h-full flex">
            <div class="w-1/2 h-full px-14 flex flex-col gap-4 justify-center">
                <span class="text-7xl font-bold">Pesan Tiket Tanpa Ribet, Nikmati Acara Tanpa Batas</span>
                <a href="/#top-popular" class="w-fit px-4 py-2 rounded-md bg-yellow-100 hover:opacity-70 duration-300">Let's
                    Explorer</a>
            </div>
            <div class="w-1/2 h-full flex flex-col justify-center">
                <img src="{{ asset('assets/img/event1.jpg') }}" alt="">
                <img src="{{ asset('assets/img/event2.jpg') }}" alt="">
                <img src="{{ asset('assets/img/event3.jpg') }}" alt="">
            </div>
        </section>
    </header>
    <main class="flex flex-col gap-14 py-14">
        <section id="top-popular" class="px-14">
            <h2 class="font-bold text-4xl pb-4">TOP POPULAR EVENT</h2>
            <div class="grid grid-cols-2 gap-2">
                @foreach ($popularEvents as $event)
                    <div class="w-full h-max relative">
                        <img src="{{ Str::startsWith($event->thumbnail, 'https://') ? $event->thumbnail : asset('storage/' . $event->thumbnail) }}"
                            alt="event" class="rounded-t-xl w-full">
                        <div class="py-2 px-4 flex justify-between bg-black text-white rounded-b-xl text-xs">
                            <span>{{ \Carbon\Carbon::parse($event->event_date)->format('j M Y') }}</span>
                            <span>{{ $event->address }}</span>
                            <span class="w-20">Buy Now ></span>
                        </div>

                        <a href="{{ route('event.detail', $event->title) }}"
                            class="absolute top-0 left-0 w-full h-full duration-300 text-white bg-black bg-opacity-70 opacity-0 hover:opacity-100 rounded-xl flex items-center justify-center">Lihat
                            Selengkapnya</a>
                    </div>
                @endforeach
                </ul>
        </section>
        <section id="other-event" class="px-14">
            <h2 class="font-bold text-4xl pb-4">OTHER EVENT</h2>
            <div class="list">
                @include('partials.events-list', compact('events', 'currentPage', 'totalPages'))
            </div>
        </section>

        <section id="benefits" class="p-14">
            <h2 class="font-bold text-4xl w-full flex justify-center mb-14">Why Choose Us?</h2>
            <ul class="grid grid-cols-3 gap-7">
                <li>
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full aspect-square max-w-40 text-neutral-500"
                            viewBox="0 0 24 24" fill="currentColor"
                            class="icon icon-tabler icons-tabler-filled icon-tabler-shield-check">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M11.998 2l.118 .007l.059 .008l.061 .013l.111 .034a.993 .993 0 0 1 .217 .112l.104 .082l.255 .218a11 11 0 0 0 7.189 2.537l.342 -.01a1 1 0 0 1 1.005 .717a13 13 0 0 1 -9.208 16.25a1 1 0 0 1 -.502 0a13 13 0 0 1 -9.209 -16.25a1 1 0 0 1 1.005 -.717a11 11 0 0 0 7.531 -2.527l.263 -.225l.096 -.075a.993 .993 0 0 1 .217 -.112l.112 -.034a.97 .97 0 0 1 .119 -.021l.115 -.007zm3.71 7.293a1 1 0 0 0 -1.415 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
                        </svg>
                    </div>
                    <h3 class="w-full text-center text-2xl">Safe Payment</h3>
                    <p class="w-full text-center">Pembayaran yang aman, nyaman, dan terpercaya setiap saat. Kami berkomitmen
                        untuk memberikan pengalaman transaksi yang terbaik, dengan berbagai metode pembayaran yang fleksibel
                        dan dukungan pelanggan yang siap membantu Anda kapan saja.</p>
                </li>
                <li>
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full aspect-square max-w-40 text-neutral-500"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-air-balloon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 19m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                            <path d="M12 16c3.314 0 6 -4.686 6 -8a6 6 0 1 0 -12 0c0 3.314 2.686 8 6 8z" />
                            <path d="M12 9m-2 0a2 7 0 1 0 4 0a2 7 0 1 0 -4 0" />
                        </svg>
                    </div>
                    <h3 class="w-full text-center text-2xl">Easy In</h3>
                    <p class="w-full text-center">Masuk mudah dan cepat tanpa repot, aman dan lancar. Proses pendaftaran
                        yang sederhana dan intuitif memastikan Anda dapat segera menikmati semua layanan kami tanpa
                        hambatan. Bergabunglah dengan kami dan rasakan kemudahan akses ke berbagai acara menarik yang kami
                        tawarkan.</p>
                </li>
                <li>
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full aspect-square max-w-40 text-neutral-500"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-discount">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 15l6 -6" />
                            <circle cx="9.5" cy="9.5" r=".5" fill="currentColor" />
                            <circle cx="14.5" cy="14.5" r=".5" fill="currentColor" />
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        </svg>
                    </div>
                    <h3 class="w-full text-center text-2xl">Exclusive Event Discounts</h3>
                    <p class="w-full text-center">Nikmati diskon eksklusif, hemat, dan spesial untuk setiap acara. Dapatkan
                        penawaran menarik dan kesempatan untuk menikmati pengalaman yang lebih baik dengan harga yang lebih
                        terjangkau. Bergabunglah dengan kami dan manfaatkan setiap kesempatan untuk berpartisipasi dalam
                        acara-acara luar biasa yang kami tawarkan.</p>
                </li>
            </ul>
        </section>
    </main>

    <script>
        let Url = new URL('{{ route('events.public.search') }}');

        function Search(keyword) {
            Url.searchParams.set('search', keyword);

            $.ajax({
                type: 'get',
                url: Url,

                success: (res) => {
                    $('.list').html(res)
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
                    $('.list').html(res)
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
@endsection
