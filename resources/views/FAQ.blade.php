@extends('layouts.app')

@section('container')
    <main class="px-32 py-28">
        <h1 class="text-4xl font-bold">Frequently Asked Questions</h1>

        <ul class="text-xl flex flex-col gap-7 py-7 text-balance">
            <li>
                <p class="font-semibold">1. Bagaimana cara membeli tiket melalui aplikasi ini?</p>
                <p>Setelah login, Anda bisa memilih acara yang ingin dihadiri, pilih jumlah tiket yang dibutuhkan, lalu
                    lanjutkan ke pembayaran. Tiket akan dikirimkan setelah pembayaran berhasil.</p>
            </li>
            <li>
                <p class="font-semibold">2. Metode pembayaran apa saja yang tersedia?</p>
                <p>Kami menyediakan berbagai metode pembayaran, seperti kartu kredit, transfer bank, dan e-wallet (Gopay,
                    OVO, dll.). Anda bisa memilih metode yang paling nyaman saat checkout.</p>
            </li>
            <li>
                <p class="font-semibold">3. Bisakah saya membatalkan tiket setelah membeli?</p>
                <p>Pembelian tiket bersifat final dan tidak dapat dibatalkan. Namun, jika acara dibatalkan oleh
                    penyelenggara, kami akan mengembalikan dana sesuai kebijakan yang berlaku.</p>
            </li>
            <li>
                <p class="font-semibold">4. Saya tidak menerima tiket setelah membayar. Apa yang harus saya lakukan?</p>
                <p>Periksa folder email spam atau junk untuk memastikan tiket tidak masuk di sana. Jika tetap tidak
                    ditemukan, Anda bisa menghubungi tim dukungan kami melalui fitur bantuan di aplikasi.
                </p>
            </li>
            <li>
                <p class="font-semibold">5. Bagaimana cara menggunakan tiket pada hari acara?</p>
                <p>Pada hari acara, Anda cukup menunjukkan tiket digital yang dikirimkan melalui email atau aplikasi
                    (misalnya kode QR) untuk di-scan di lokasi.
                </p>
            </li>
            <li>
                <p class="font-semibold">6. Apakah tiket ini bisa dipindahtangankan?</p>
                <p>Beberapa tiket dapat dipindahtangankan tergantung pada kebijakan penyelenggara acara. Silakan periksa
                    syarat dan ketentuan tiket Anda sebelum memindahkan tiket kepada orang lain.
                </p>
            </li>
            <li>
                <p class="font-semibold">7. Bagaimana jika acara ditunda atau dibatalkan?
                </p>
                <p>Jika acara dibatalkan atau ditunda, kami akan segera memberi tahu Anda melalui email atau notifikasi
                    aplikasi. Pengembalian dana akan diproses sesuai kebijakan yang berlaku.
                </p>
            </li>
            <li>
                <p class="font-semibold">8. Apakah ada biaya tambahan selain harga tiket?</p>
                <p>Beberapa acara mungkin membebankan biaya layanan atau pajak tambahan. Semua biaya akan ditampilkan secara
                    transparan saat proses pembelian tiket.
                </p>
            </li>
        </ul>
    </main>
@endsection
