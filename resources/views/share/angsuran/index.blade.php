<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Angsuran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('share.angsuran.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-5 inline-block">
                Tambah Angsuran
            </a>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border">No</th>
                            <th class="py-2 px-4 border">Nama Anggota</th>
                            <th class="py-2 px-4 border">Jumlah Bayar</th>
                            <th class="py-2 px-4 border">Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($angsurans as $item)
                            <tr>
                                <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border">{{ $item->pinjam->anggota->user->name }}</td>
                                <td class="py-2 px-4 border">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                                <td class="py-2 px-4 border">{{ $item->tanggal_bayar }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
