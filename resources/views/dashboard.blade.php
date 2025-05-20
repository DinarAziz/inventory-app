@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 py-12">
    <div class="max-w-5xl mx-auto px-6 space-y-10">

        <!-- Greeting Card -->
        <div class="bg-white shadow-xl rounded-3xl p-8 border-l-8 border-indigo-400">
            <div class="mb-6">
                <h1 class="text-4xl font-extrabold text-gray-800 mb-2">👋 Hai, Selamat Datang!</h1>
                <p class="text-lg text-gray-600">di <span class="font-semibold text-indigo-600">Aplikasi Inventory Barang</span></p>
            </div>

            <div class="mt-4 text-gray-700 space-y-4 leading-relaxed">
                <p>
                    Aplikasi ini membantu kamu dalam mencatat dan mengelola inventaris barang seperti:
                    <span class="inline-block">📦 Barang</span>,
                    <span class="inline-block">🗂️ Kategori</span>,
                    <span class="inline-block">📋 Peminjaman</span>, dan lainnya.
                </p>

                <p>
                    Dirancang untuk kemudahan, aplikasi ini cocok digunakan di lingkungan sekolah, kantor, ataupun organisasi.
                    Cukup klik menu di samping untuk mulai menggunakan fitur-fitur utama 💻.
                </p>

                <p>
                    Semoga aplikasi ini bermanfaat dan membuat pekerjaanmu lebih efisien ✨
                </p>
            </div>
        </div>

        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-lg transition">
                <div class="text-4xl mb-2">📦</div>
                <h3 class="font-bold text-lg text-gray-800 mb-1">Data Barang</h3>
                <p class="text-sm text-gray-600">Lihat dan kelola daftar barang inventaris.</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-lg transition">
                <div class="text-4xl mb-2">🗂️</div>
                <h3 class="font-bold text-lg text-gray-800 mb-1">Kategori</h3>
                <p class="text-sm text-gray-600">Kelompokkan barang berdasarkan jenisnya.</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-lg transition">
                <div class="text-4xl mb-2">👥</div>
                <h3 class="font-bold text-lg text-gray-800 mb-1">Pengguna</h3>
                <p class="text-sm text-gray-600">Kelola akses pengguna ke sistem ini.</p>
            </div>
        </div>

        <!-- Quote atau Motivasi -->
        <div class="text-center mt-8 text-gray-700 italic">
            <p>“Kerapihan data hari ini, kemudahan kerja esok hari.” 📊</p>
        </div>
    </div>
</div>
@endsection
