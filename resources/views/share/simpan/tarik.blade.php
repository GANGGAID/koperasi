<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penarikan Simpanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-500 text-white p-4 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($simpan)
                        <h2 class="text-lg font-semibold mb-4">Detail Simpanan Anggota</h2>
                        <p>Nama Anggota: {{ $simpan->anggota->nama }}</p>
                        <p>Jenis Simpanan: {{ $simpan->jenis }}</p>
                        <p>Total Simpanan: Rp {{ number_format($simpan->jumlah, 2, ',', '.') }}</p>

                        <form action="{{ route('simpanan.prosesPenarikan', $simpan->id) }}" method="POST" class="mt-6">
                            @csrf
                            <div class="mb-4">
                                <label for="jumlah" class="block">Jumlah Penarikan</label>
                                <input type="number" name="jumlah" id="jumlah" class="w-full px-3 py-2 border rounded text-black" placeholder="Masukkan jumlah penarikan" required>
                                @error('jumlah')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex space-x-4">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tarik</button>
                                <button type="button" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Cetak</button>
                            </div>
                        </form>
                    @else
                        <div class="text-center text-gray-400 text-lg font-semibold mt-6">
                            Data simpanan tidak tersedia.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
