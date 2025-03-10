<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Simpanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Riwayat Simpanan {{ $simpanan->anggota->nama }}
                </h3>
<!-- Menampilkan total simpanan wajib dan pokok -->
<div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-md">
    <p class="text-md font-semibold text-gray-800 dark:text-gray-300">
        Total Simpanan Pokok: Rp {{ number_format($total_simpanan_pokok, 0, ',', '.') }}
    </p>
    <p class="text-md font-semibold text-gray-800 dark:text-gray-300">
        Total Simpanan Wajib: Rp {{ number_format($total_simpanan_wajib, 0, ',', '.') }}
    </p>
</div>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border">No</th>
                            <th class="py-2 px-4 border">Jenis Simpanan</th>
                            <th class="py-2 px-4 border">Jumlah</th>
                            <th class="py-2 px-4 border">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat as $item)
                        <tr>
                            <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border">{{ $item->jenis }}</td>
                            <td class="py-2 px-4 border">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td class="py-2 px-4 border">{{ $item->tanggal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    <a href="{{ route('share.simpan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
