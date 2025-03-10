<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Simpanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Pesan sukses -->
            @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <a href="{{ route('share.simpan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-5 inline-block">
                Tambah Simpanan
            </a>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border">No</th>
                            <th class="py-2 px-4 border">Nama Anggota</th>
                            <th class="py-2 px-4 border">Jenis Simpanan</th>
                            <th class="py-2 px-4 border">Jumlah</th>
                            <th class="py-2 px-4 border">Tanggal</th>
                            <th class="py-2 px-4 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($simpans as $item)
                        <tr>
                            <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border">{{ $item->anggota->nama ?? 'Nama Tidak Tersedia' }}</td>
                            <td class="py-2 px-4 border">{{ $item->jenis }}</td>
                            <td class="py-2 px-4 border">Rp {{ number_format($item->total_jumlah, 0, ',', '.') }}</td>
                            <td class="py-2 px-4 border">{{ $item->tanggal_terbaru }}</td>

                            <td class="py-2 px-4 border flex space-x-2">
                                <a href="{{ route('share.simpan.edit', $item->id_terbaru) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                                <a href="{{ route('share.simpan.tarik', $item->id_terbaru) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Tarik</a>
                                <a href="{{ route('share.simpan.riwayat', $item->id_terbaru) }}"  class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600">Riwayat</a>
                                <a href="{{ route('share.simpan.create', ['anggota_id' => $item->anggota_id]) }}"
                                    class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">
                                    Tambah Sekarang
                                 </a>
                                 @if(!empty($item->id))
                                 <form action="{{ route('share.simpan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus simpanan ini?')">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Hapus</button>
                                 </form>
                             @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
