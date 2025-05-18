@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Riwayat Peminjaman</h2>

    @if ($loans->isEmpty())
        <div class="text-gray-600 dark:text-gray-300">Belum ada data peminjaman.</div>
    @else
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Barang</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Jumlah</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Pinjam</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Tenggat</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($loans as $loan)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                {{ $loan->item->name }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                {{ $loan->quantity }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($loan->borrow_date)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($loan->due_date)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-2 text-sm">
                                @php
                                    $colors = [
                                        'pending' => 'bg-gray-300 text-gray-800',
                                        'approved' => 'bg-green-500 text-white',
                                        'returned' => 'bg-blue-500 text-white',
                                        'rejected' => 'bg-red-500 text-white',
                                        'overdue' => 'bg-yellow-400 text-black',
                                    ];
                                @endphp
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $colors[$loan->status] ?? 'bg-gray-200' }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
