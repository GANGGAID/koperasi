<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hasil Simulasi Pinjaman') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border px-4 py-2 text-center">Bulan</th>
                            <th class="border px-4 py-2 text-center">Sisa Pinjaman</th>
                            <th class="border px-4 py-2 text-center">Bunga</th>
                            <th class="border px-4 py-2 text-center">Pokok per Bulan</th>
                            <th class="border px-4 py-2 text-center">Potongan per Bulan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($hasilSimulasi) && count($hasilSimulasi) > 0)
                            @foreach($hasilSimulasi as $item)
                                <tr class="text-center border-t hover:bg-gray-100 text-white dark:hover:bg-gray-700">
                                    <td class="border px-4 py-2">{{ $item['bulan'] }}</td>
                                    <td class="border px-4 py-2">{{ number_format((float) $item['sisaPokok'], 0, ',', '.') }}</td>
                                    <td class="border px-4 py-2">{{ number_format((float) $item['bunga'], 0, ',', '.') }}</td>
                                    <td class="border px-4 py-2">{{ number_format((float) $item['pokok'], 0, ',', '.') }}</td>
                                    <td class="border px-4 py-2 font-semibold">{{ number_format((float) $item['total'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="border px-4 py-3 text-center text-gray-500">Tidak ada data simulasi.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
