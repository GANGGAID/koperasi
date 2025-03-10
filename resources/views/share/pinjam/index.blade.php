<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Pinjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('share.pinjam.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-5 inline-block">
                Tambah Pinjaman
            </a>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border">No</th>
                            <th class="py-2 px-4 border">Nama Anggota</th>
                            <th class="py-2 px-4 border">Jumlah</th>
                            <th class="py-2 px-4 border">Sisa Pinjaman</th>
                            <th class="py-2 px-4 border">Bunga</th>
                            <th class="py-2 px-4 border">Tenor</th>
                            <th class="py-2 px-4 border">Tanggal Pinjam</th>
                            <th class="py-2 px-4 border">Jatuh Tempo</th>
                            <th class="py-2 px-4 border">Pengajuan</th>
                            <th class="py-2 px-4 border">Persetujuan</th>
                            <th class="py-2 px-4 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pinjaman as $item)
                            <tr>
                                <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border">{{ $item->anggota->nama }}</td>
                                <td class="py-2 px-4 border">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td class="py-2 px-4 border">Rp {{ number_format($item->sisa_pinjaman, 0, ',', '.') }}</td>
                                <td class="py-2 px-4 border">{{ $item->bunga }}%</td>
                                <td class="py-2 px-4 border">{{ $item->tenor }} Bulan</td>
                                <td class="py-2 px-4 border">{{ $item->tanggal_pinjam }}</td>
                                <td class="py-2 px-4 border">{{ $item->tanggal_jatuh_tempo }}</td>
                                <td class="py-2 px-4 border">{{ $item->tanggal_pengajuan }}</td>
                                <td class="py-2 px-4 border">{{ $item->tanggal_persetujuan ?? '-' }}</td>
                                <td class="py-2 px-4 border flex space-x-2">
                                    {{-- <a href="{{ route('share.pinjam.detail', $item->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Detail</a> --}}
                                    <a href="{{ route('share.pinjam.edit', $item->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                                    <a href="{{ route('share.pinjam.bayar', $item->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Bayar
                                    </a>
                                    <a href="{{ route('share.pinjam.riwayat', $item->id) }}" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600">
                                        Riwayat
                                    </a>
                                    <form action="{{ route('share.pinjam.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pinjaman ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
