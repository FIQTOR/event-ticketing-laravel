<aside class="p-0 fixed w-full z-50 md:relative md:w-fit">
    <div class="md:hidden p-4">
        <div
            class="w-full h-14 bg-yellow-200 rounded-full flex items-center justify-end gap-4 px-7 text-white shadow-xl">

            <a href="{{ route('home') }}" class="hover:opacity-70">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
            </a>
            <button onclick="handleNav()" class="hover:opacity-70">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 6l16 0" />
                    <path d="M4 12l16 0" />
                    <path d="M4 18l16 0" />
                </svg>
            </button>
        </div>
    </div>
    <div id="bgdark" class="absolute top-0 left-0 bg-black bg-opacity-70 w-full h-screen hidden z-10 md:hidden">
    </div>
    <ul id="navMobile"
        class="absolute md:relative top-0 w-[80%] md:min-w-72 md:max-w-sm h-full min-h-screen bg-yellow-100 border-r-2 border-r-yellow-200 px-7 shadow-xl flex flex-col justify-start gap-4 -left-full md:left-0 duration-300 z-20 md:gap-2">
        <li class="w-full my-4 flex justify-center items-center">
            <img src="{{ asset('icon.webp') }}" alt="" class="w-[80%]">
        </li>
        <li class="absolute top-4 right-4 md:hidden">
            <button onclick="handleNav()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
        </li>
        <li class="w-full hidden md:flex">
            <a href="{{ route('home') }}"
                class="relative w-full py-2 hover:opacity-70 duration-300
before:bg-yellow-200 before:h-1 before:w-0 before:absolute before:bottom-0 md:before:bottom-1 before:rounded-full hover:before:w-full before:duration-300">Homepage</a>
        </li>
        <li class="flex w-full">
            <a href="{{ route('dashboard') }}"
                class="relative w-full py-2 hover:opacity-70 duration-300
before:bg-yellow-200 before:h-1 before:w-0 before:absolute before:bottom-0 md:before:bottom-1 before:rounded-full hover:before:w-full before:duration-300">Dashboard</a>
        </li>
        @can('panel users')
            <li class="flex w-full">
                <a href="{{ route('users.index') }}"
                    class="relative w-full py-2 hover:opacity-70 duration-300
before:bg-yellow-200 before:h-1 before:w-0 before:absolute before:bottom-0 md:before:bottom-1 before:rounded-full hover:before:w-full before:duration-300">User
                    Data</a>
            </li>
        @endcan
        <li class="flex">
            <a href="{{ route('events.index') }}"
                class="relative w-full py-2 hover:opacity-70 duration-300
before:bg-yellow-200 before:h-1 before:w-0 before:absolute before:bottom-0 md:before:bottom-1 before:rounded-full hover:before:w-full before:duration-300">Event
                Data</a>
        </li>
        <li class="flex">
            <a href="{{ route('payments.index') }}"
                class="relative w-full py-2 hover:opacity-70 duration-300
before:bg-yellow-200 before:h-1 before:w-0 before:absolute before:bottom-0 md:before:bottom-1 before:rounded-full hover:before:w-full before:duration-300">Payment
                Data</a>
        </li>
        {{-- <li class="flex">
            <a href="{{ route('payment.finder') }}"
                class="relative w-full py-2 hover:opacity-70 duration-300
before:bg-yellow-200 before:h-1 before:w-0 before:absolute before:bottom-0 md:before:bottom-1 before:rounded-full hover:before:w-full before:duration-300">Invoice
                Finder</a>
        </li> --}}
        <li class="flex">
            <a href="{{ route('invoice.scan') }}"
                class="relative w-full py-2 hover:opacity-70 duration-300
before:bg-yellow-200 before:h-1 before:w-0 before:absolute before:bottom-0 md:before:bottom-1 before:rounded-full hover:before:w-full before:duration-300">Ticket
                Scanner</a>
        </li>
    </ul>
</aside>
