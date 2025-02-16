<ul class="grid grid-cols-2 gap-2">
    @foreach ($events as $event)
        @if (!$event->isTopPopular)
            <li class="w-full h-max relative">
                <img src="{{ Str::startsWith($event->thumbnail, 'https://') ? $event->thumbnail : asset('storage/' . $event->thumbnail) }}"
                    alt="event" class="rounded-t-xl w-full">
                <div class="py-2 px-4 flex justify-between bg-black text-white rounded-b-xl text-xs">
                    <div>
                        <span>{{ \Carbon\Carbon::parse($event->event_date)->format('j M Y') }}</span>
                    </div>
                    <div>
                        <span>{{ $event->address }}</span>
                    </div>
                    <div class="w-20">
                        <span>Buy Now ></span>
                    </div>
                </div>

                <a href="{{ route('event.detail', $event->title) }}"
                    class="absolute top-0 left-0 w-full h-full duration-300 text-white bg-black bg-opacity-70 opacity-0 hover:opacity-100 rounded-xl flex items-center justify-center">Lihat
                    Selengkapnya</a>
            </li>
        @endif
    @endforeach
</ul>

<div class="w-full flex flex-col gap-2 items-center py-4 text-sm">
    <div class="flex gap-1">
        @for ($a = $currentPage - 3; $a <= $currentPage + 3; $a++)
            @if ($a > 0 && $a <= $totalPages)
                <button onclick="HandlePage({{ $a }})"
                    class="w-6 py-2 border rounded-md hover:bg-neutral-400 flex justify-center items-center">{{ $a }}</button>
            @endif
        @endfor
    </div>
    <div class="flex gap-1">
        @if ($currentPage > 2)
            <button onclick="HandlePage({{ $currentPage - 2 }})"
                class="w-10 py-2 border rounded-md hover:bg-neutral-400 flex justify-center items-center">
                << </button>
        @endif
        @if ($currentPage > 1)
            <button onclick="HandlePage({{ $currentPage - 1 }})"
                class="w-20 py-2 border rounded-md hover:bg-neutral-400 flex justify-center items-center">
                < Previous</button>
        @endif
        @if ($currentPage < $totalPages)
            <button onclick="HandlePage({{ $currentPage + 1 }})"
                class="w-20 py-2 border rounded-md hover:bg-neutral-400 flex justify-center items-center">Next
                ></button>
        @endif
        @if ($currentPage < $totalPages - 1)
            <button onclick="HandlePage({{ $currentPage + 2 }})"
                class="w-10 py-2 border rounded-md hover:bg-neutral-400 flex justify-center items-center">
                >></button>
        @endif
    </div>
    <p>Pages: {{ $currentPage }} / {{ $totalPages }}</p>
</div>
