@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 py-12 px-4 sm:px-8 lg:px-16">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white shadow-xl rounded-3xl p-8 border-l-8 border-indigo-400">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">📖 Riwayat Peminjaman</h2>

            @if ($loans->isEmpty())
                <div class="text-center text-gray-600">Belum ada data peminjaman yang tercatat.</div>
            @else
                <div class="overflow-x-auto rounded-lg mt-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-100 text-indigo-800 text-sm uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">Barang</th>
                                <th class="px-4 py-3 text-left font-semibold">Jumlah</th>
                                <th class="px-4 py-3 text-left font-semibold">Tanggal Pinjam</th>
                                <th class="px-4 py-3 text-left font-semibold">Tenggat</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100 text-gray-700">
                            @foreach ($loans as $loan)
                                <tr class="hover:bg-indigo-50">
                                    <td class="px-4 py-3">{{ $loan->item->name }}</td>
                                    <td class="px-4 py-3">{{ $loan->quantity }}</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($loan->due_date)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-3">
                                        @php
                                            $colors = [
                                                'pending' => 'bg-gray-300 text-gray-800',
                                                'approved' => 'bg-green-500 text-white',
                                                'returned' => 'bg-blue-500 text-white',
                                                'rejected' => 'bg-red-500 text-white',
                                                'overdue' => 'bg-yellow-400 text-black',
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $colors[$loan->status] ?? 'bg-gray-200' }}">
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
    </div>
</div>
@endsection
