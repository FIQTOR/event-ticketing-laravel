@extends('layouts.app')

@section('container')
    <main class="px-32 py-28">
        <h1 class="text-4xl font-bold">Terms and Conditions</h1>

        <ul class="text-xl flex flex-col gap-7 py-7 text-balance list-decimal pl-4">
            <li>
                <span class="font-semibold">Penggunaan Aplikasi</span>
                <ul class="list-disc pl-4">
                    <li>Aplikasi ini dirancang untuk memudahkan pembelian tiket acara secara online. Dengan menggunakan
                        aplikasi, pengguna setuju untuk mematuhi semua aturan yang berlaku di dalamnya.</li>
                </ul>
            </li>
            <li>
                <span class="font-semibold">Informasi Pengguna</span>
                <ul class="list-disc pl-4">
                    <li>Pengguna diharuskan memberikan informasi yang benar dan akurat saat melakukan pembelian tiket.
                        Kesalahan atau ketidakakuratan informasi dapat menyebabkan pengguna tidak dapat menggunakan tiket
                        yang telah dibeli.</li>
                </ul>
            </li>
            <li>
                <span class="font-semibold">Pembelian dan Pembayaran</span>
                <ul class="list-disc pl-4">
                    <li>Semua pembelian tiket bersifat final dan tidak dapat dibatalkan atau dikembalikan, kecuali jika
                        penyelenggara acara atau aplikasi menyediakan kebijakan refund tertentu.</li>
                    <li>Pembayaran dapat dilakukan melalui metode yang tersedia di aplikasi. Pengguna bertanggung jawab atas
                        biaya transaksi yang mungkin timbul dari pembayaran tersebut.</li>
                </ul>
            </li>
            <li>
                <span class="font-semibold">Pengiriman Tiket</span>
                <ul class="list-disc pl-4">
                    <li>Tiket akan dikirimkan secara elektronik melalui email atau kode QR yang tersedia di aplikasi setelah
                        pembayaran dikonfirmasi. Pengguna bertanggung jawab untuk memastikan tiket diterima dan siap
                        digunakan pada hari acara.</li>
                </ul>
            </li>
            <li>
                <span class="font-semibold">Ketentuan Pengembalian Dana (Refund)</span>
                <ul class="list-disc pl-4">
                    <li>Pengembalian dana hanya akan dilakukan jika acara dibatalkan atau ditunda oleh penyelenggara acara.
                        Pengembalian dana akan diproses sesuai dengan kebijakan yang berlaku dan mungkin memakan waktu
                        beberapa hari kerja.</li>
                </ul>
            </li>
            <li>
                <span class="font-semibold">Perubahan dan Pembatalan Acara</span>
                <ul class="list-disc pl-4">
                    <li>Penyelenggara acara memiliki hak untuk mengubah tanggal, lokasi, atau membatalkan acara. Jika
                        terjadi perubahan atau pembatalan, pengguna akan diberitahu melalui email atau notifikasi dalam
                        aplikasi.</li>
                </ul>
            </li>
            <li>
                <span class="font-semibold">Kode Promo dan Diskon</span>
                <ul class="list-disc pl-4">
                    <li>Aplikasi dapat menyediakan kode promo atau diskon pada waktu tertentu. Kode promo ini hanya dapat
                        digunakan sesuai dengan ketentuan yang berlaku dan tidak dapat digabungkan dengan promosi lainnya.
                    </li>
                </ul>
            </li>
            <li>
                <span class="font-semibold">Hak Cipta dan Konten</span>
                <ul class="list-disc pl-4">
                    <li>Semua konten dalam aplikasi, termasuk teks, gambar, dan logo, dilindungi oleh hak cipta. Pengguna
                        tidak diperkenankan untuk menyalin, mendistribusikan, atau menggunakan konten tanpa izin tertulis
                        dari pemilik hak cipta.</li>
                </ul>
            </li>
            <li>
                <span class="font-semibold">Tanggung Jawab</span>
                <ul class="list-disc pl-4">
                    <li>Aplikasi tidak bertanggung jawab atas kerugian atau masalah yang mungkin timbul akibat penggunaan
                        tiket, termasuk akses yang tidak sah atau penggunaan yang salah oleh pihak ketiga.</li>
                </ul>
            </li>
        </ul>
    </main>
@endsection
