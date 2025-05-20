@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 py-12 px-4 sm:px-8 lg:px-16">

    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl p-8 border-l-8 border-indigo-400">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">📋 Form Peminjaman Barang</h2>

        @if (session('success'))
            <div class="mb-6 text-center bg-green-100 text-green-800 rounded px-4 py-3 shadow">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('loan.store') }}">
            @csrf

            <div class="mb-6">
                <input type="text" id="search-barang" placeholder="🔍 Cari barang..."
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:ring focus:ring-blue-300" />
            </div>

            <div id="barang-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                @foreach ($items as $item)
                    <label class="group relative border border-gray-300 rounded-xl overflow-hidden cursor-pointer shadow-sm hover:shadow-md bg-white transition-all">
                        <input type="radio" name="item_id" value="{{ $item->id }}" class="absolute inset-0 opacity-0 peer" required>
                        <div class="p-4">
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-40 object-cover rounded mb-3 group-hover:scale-105 transition">
                            @endif
                            <div class="font-semibold text-gray-800 text-sm mb-1">{{ $item->name }}</div>
                            <div class="text-xs text-gray-600">Stok: {{ $item->stock }}</div>
                            <div class="text-xs text-gray-600">Kondisi: {{ ucfirst($item->condition) }}</div>
                        </div>
                        <div class="absolute inset-0 border-2 border-blue-600 rounded-md hidden peer-checked:block pointer-events-none"></div>
                    </label>
                @endforeach
            </div>

            @error('item_id')
                <div class="text-sm text-red-600 text-center mb-4">{{ $message }}</div>
            @enderror

            <div class="bg-white rounded-2xl p-6 shadow space-y-6">
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">📦 Jumlah</label>
                    <input type="number" name="quantity" id="quantity" min="1" class="w-full px-4 py-2 rounded border border-gray-300 shadow-sm">
                    @error('quantity')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">📅 Tenggat Waktu</label>
                    <input type="date" name="due_date" id="due_date" class="w-full px-4 py-2 rounded border border-gray-300 shadow-sm">
                    @error('due_date')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-semibold text-sm transition shadow">
                        🚀 Ajukan Peminjaman
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const cards = document.querySelectorAll('#barang-grid label.group');

    function showMaxFive(filteredCards) {
        cards.forEach(card => card.style.display = 'none');
        filteredCards.slice(0, 5).forEach(card => card.style.display = '');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-barang');
        showMaxFive(Array.from(cards));

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            const filtered = Array.from(cards).filter(card =>
                card.textContent.toLowerCase().includes(keyword)
            );
            showMaxFive(filtered);
        });
    });
</script>
@endsection
