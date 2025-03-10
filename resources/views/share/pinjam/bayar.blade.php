<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bayar Pinjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
    <div class="text-red-500 bg-red-100 border border-red-400 p-3 rounded mb-4">
        <strong>Terjadi Kesalahan:</strong>
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                <form action="{{ route('share.pinjam.bayar.store', $pinjaman->id) }}" method="POST">
                    @csrf

                    <!-- Nama Anggota -->
                    <div class="mb-4">
                        <p class="text-gray-700 dark:text-gray-200 font-bold">Nama Anggota: {{ $pinjaman->anggota->nama }}</p>
                        <p class="text-gray-700 dark:text-gray-200 font-bold">Sisa Pinjaman: Rp {{ number_format($pinjaman->sisa_pinjaman, 0, ',', '.') }}</p>
                        <input type="hidden" name="pinjam_id" value="{{ $pinjaman->id }}">
                    </div>

                    <!-- Jumlah Pembayaran -->
                    <div class="mb-4">
                        <label for="jumlah_bayar" class="block text-gray-700 dark:text-gray-200 font-bold">Jumlah Pembayaran</label>
                        <input type="number" name="jumlah_bayar" id="jumlah_bayar" required
                            class="w-full mt-2 px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white"
                            placeholder="Masukkan jumlah pembayaran">
                    </div>

                    <!-- Tanggal Pembayaran -->
                    <div class="mb-4">
                        <label for="tanggal_bayar" class="block text-gray-700 dark:text-gray-200 font-bold">Tanggal Pembayaran</label>
                        <input type="date" name="tanggal_bayar" id="tanggal_bayar" required
                            class="w-full mt-2 px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Simpan Pembayaran
                        </button>
                        <a href="{{ route('share.pinjam.index') }}"
                            class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
