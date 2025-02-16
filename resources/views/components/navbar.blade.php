<nav class="fixed w-full h-14 bg-yellow-50 nav-shadow px-14 z-50 border-b">
    <a href="/#" class="absolute pt-1 w-96 text-2xl font-bold flex gap-4 items-center">
        <img src="{{ asset('icon.webp') }}" alt="" class="h-10">
        <h1>TICKETA</h1>
    </a>
    <ul class="h-full flex justify-end gap-7 items-center">
        <li>
            <a href="{{ route('home') }}" class="hover:opacity-70">Beranda</a>
        </li>
        <li>
            <a href="{{ route('myinvoice') }}" class="hover:opacity-70">My Invoice</a>
        </li>
        <li>
            <a href="{{ route('mypayment') }}" class="hover:opacity-70">My Payment</a>
        </li>
        @can('panel dashboard')
            <li>
                <a href="{{ route('dashboard') }}" class="hover:opacity-70">Dashboard</a>
            </li>
        @endcan
        @auth
            <li>
                <a href="{{ route('profile') }}" class="hover:opacity-70">Profile</a>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}" class="hover:opacity-70">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}"
                    class="hover:opacity-70 py-2 px-7 rounded-full border border-black">Register</a>
            </li>
        @endauth
    </ul>
</nav>

<script>
    if (window.location.pathname === '/login' || window.location.pathname == '/register') {
        document.querySelector('nav').classList.remove('bg-yellow-50');
        document.querySelector('nav').classList.remove('nav-shadow');
        document.querySelector('nav').classList.add('text-white');
        document.querySelector('nav').classList.add('backdrop-blur-lg');
    }
</script>
