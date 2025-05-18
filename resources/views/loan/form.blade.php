@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 space-y-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Form Peminjaman Barang</h2>

        @if (session('success'))
            <div class="px-4 py-3 rounded bg-green-100 text-green-800 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('loan.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="item_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih Barang</label>
                <select name="item_id" id="item_id" class="select2-custom w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm">
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} (Stok: {{ $item->stock }})</option>
                    @endforeach
                </select>
                @error('item_id')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah</label>
                <input type="number" name="quantity" id="quantity" min="1" value="{{ old('quantity') }}" class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm">
                @error('quantity')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tenggat Waktu</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm">
                @error('due_date')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md transition text-sm font-semibold">
                    Ajukan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            height: 42px;
            padding: 6px 12px;
            font-size: 0.875rem;
            color: #111827;
        }

        .dark .select2-container--default .select2-selection--single {
            background-color: #1f2937;
            border-color: #374151;
            color: #e5e7eb;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: inherit;
            line-height: 1.5rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 42px;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#item_id').select2({
                placeholder: 'Cari barang...',
                width: '100%'
            });
        });
    </script>
@endsection
