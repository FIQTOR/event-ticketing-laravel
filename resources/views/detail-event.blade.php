@extends('layouts.app')

@section('container')
    <main class="px-14 py-28">
        <div class="flex gap-7">
            <div class="w-full">
                <div class="flex flex-col gap-2">
                    <div class="max-w-[700px] w-screen">
                        <img src="{{ Str::startsWith($event->thumbnail, 'https://') ? $event->thumbnail : asset('storage/' . $event->thumbnail) }}"
                            alt="" class="rounded-xl">
                    </div>
                    <span class="text-2xl">{{ $event->title }}</span>
                </div>
                <div class="w-full h-px bg-black my-4"></div>
                <p>{{ $event->description }}</p>
            </div>
            <aside class="p-4 w-2/5">
                <div class="w-full h-screen p-7 rounded-2xl shadow-2xl flex flex-col justify-between">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                class="min-w-[24px]" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-alarm">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M12 10l0 3l2 0" />
                                <path d="M7 4l-2.75 2" />
                                <path d="M17 4l2.75 2" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($event->event_date)->format('j M Y') }}</span>
                        </div>
                        <div class="flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="min-w-[24px]"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                <path
                                    d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                            </svg>
                            <span>{{ $event->address }}</span>
                        </div>
                        <div class="flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" class="min-h-[24px]">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M4.99 12.862a7.1 7.1 0 0 0 12.171 3.924a1.956 1.956 0 0 1 -.156 -.637l-.005 -.149l.005 -.15a2 2 0 1 1 1.769 2.137a9.099 9.099 0 0 1 -15.764 -4.85a1 1 0 0 1 1.98 -.275z" />
                                <path d="M12 8a4 4 0 1 1 -3.995 4.2l-.005 -.2l.005 -.2a4 4 0 0 1 3.995 -3.8z" />
                                <path
                                    d="M13.142 3.09a9.1 9.1 0 0 1 7.848 7.772a1 1 0 0 1 -1.98 .276a7.1 7.1 0 0 0 -6.125 -6.064a7.096 7.096 0 0 0 -6.048 2.136a2 2 0 1 1 -3.831 .939l-.006 -.149l.005 -.15a2 2 0 0 1 2.216 -1.838a9.094 9.094 0 0 1 7.921 -2.922z" />
                            </svg>
                            <span>Rp{{ number_format($event->price, 0, '.', '.') }} / guest</span>
                        </div>
                    </div>

                    <form action="{{ route('payments.store', $event->id) }}" method="POST" class="flex flex-col gap-4">
                        @csrf
                        <div class="flex items-center gap-2">
                            <label for="guest">Guest</label>
                            <input type="number" value="1" min="1" max="100" name="guest" id="guest"
                                class="w-full px-4 py-2 rounded-full border">
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="layout">Layout</label>
                            <div class="flex flex-col">
                                @foreach (json_decode($event->layouts) as $layout)
                                    <div class="flex gap-2">
                                        <input type="radio" name="layout" id="layout"
                                            value="{{ $layout }}">{{ $layout }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <span></span>
                        <button class="py-2 w-full rounded-full bg-blue-500 hover:opacity-70 text-white">BUY NOW</button>
                    </form>
                </div>
            </aside>
        </div>
    </main>
@endsection
