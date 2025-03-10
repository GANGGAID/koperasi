<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pembayaran Angsuran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-500">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('share.angsuran.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="pinjam_id" class="block text-gray-700 dark:text-gray-200 font-bold">Pilih Pinjaman</label>
                        @if($pinjaman->isEmpty())
                            <p class="text-red-500">Tidak ada pinjaman yang bisa dibayar.</p>
                        @else
                        <select name="pinjam_id" id="pinjam_id">
                            @foreach ($pinjaman as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->anggota->user->name }} - Rp {{ number_format($item->sisa_pinjaman, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                    </div>

                    <div class="mb-4">
                        <label for="jumlah_bayar" class="block text-gray-700 dark:text-gray-200 font-bold">Jumlah Pembayaran</label>
                        <input type="number" name="jumlah_bayar" id="jumlah_bayar" required
                            class="w-full mt-2 px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white"
                            placeholder="Masukkan jumlah pembayaran">
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_bayar" class="block text-gray-700 dark:text-gray-200 font-bold">Tanggal Pembayaran</label>
                        <input type="date" name="tanggal_bayar" id="tanggal_bayar" required
                            class="w-full mt-2 px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Simpan Pembayaran
                        </button>
                        <a href="{{ route('share.angsuran.index') }}"
                            class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
