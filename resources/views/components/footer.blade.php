<footer class="w-full flex flex-col p-7 md:p-14 bg-yellow-200 text-black z-50">
    <div class="flex justify-between flex-col md:flex-row gap-14">
        <ul class="flex flex-wrap md:justify-center gap-7 md:gap-28">
            <li>
                <h2 class="font-medium text-xl">Navigation</h2>
                <ul>
                    <li>
                        <a href="{{ route('home') }}" class="hover:opacity-80">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('myinvoice') }}" class="hover:opacity-80">
                            My Invoice
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <h2 class="font-medium text-xl">Bantuan</h2>
                <ul>
                    <li>
                        <a href="{{ route('terms-condition') }}" class="hover:opacity-80">
                            Syarat & Ketentuan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('FAQ') }}" class="hover:opacity-80">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:opacity-80">
                            Hubungi Kami
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <h2 class="font-medium text-xl">Sosial Media</h2>
                <ul class="flex gap-2 mt-4">
                    <li class="hover:opacity-80">
                        <a href="https://www.instagram.com/fiqtorr" class="hover:opacity-80">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                                <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                <path d="M16.5 7.5l0 .01" />
                            </svg>
                        </a>
                    </li>
                    <li class="hover:opacity-80">
                        <a href="https://fiqtor.com" class="hover:opacity-80">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-brand-youtube">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M2 8a4 4 0 0 1 4 -4h12a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4v-8z" />
                                <path d="M10 9l5 3l-5 3z" />
                            </svg>
                        </a>
                    </li>
                    <li class="hover:opacity-80">
                        <a href="https://fiqtor.com" class="hover:opacity-80">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                            </svg>
                        </a>
                    </li>
                    <li class="hover:opacity-80">
                        <a href="https://fiqtor.com" class="hover:opacity-80">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-brand-x">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="flex flex-col max-w-sm">
            <h2 class="text-4xl font-orbitron">TICKETA</h2>
            <p>Ticket Store (Festival, Event, etc)</p>
        </div>
    </div>
    <div class="w-full
                justify-center flex pt-7">
        <span class="font-medium">Copyright &copy; 2024 by <span class="font-orbitron">TICKETA</span> |
            All Rights Reserved</span>
    </div>
</footer>


<script>
    if (window.location.pathname == '/login' || window.location.pathname == '/register') {
        document.querySelector('footer').classList.remove('bg-yellow-200');
        document.querySelector('footer').classList.remove('text-black');
        document.querySelector('footer').classList.add('bg-black');
        document.querySelector('footer').classList.add('bg-opacity-50');
        document.querySelector('footer').classList.add('backdrop-blur-sm');
        document.querySelector('footer').classList.add('text-white');
    }
</script>
