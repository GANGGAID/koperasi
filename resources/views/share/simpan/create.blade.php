<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Simpanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('share.simpan.store') }}" method="POST">
                    @csrf

                    <!-- Pilih Nama Anggota -->
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 font-bold">Nama Anggota</label>
                        <select name="anggota_id" required class="w-full mt-2 px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                            <option value="">-- Pilih Anggota --</option>
                            @foreach ($semuaAnggota as $anggota)
                                <option value="{{ $anggota->id }}"
                                    {{ ($anggotaTerpilih && $anggotaTerpilih->id == $anggota->id) ? 'selected' : '' }}>
                                    {{ $anggota->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jenis Simpanan -->
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 font-bold">Jenis Simpanan</label>
                        <select name="jenis" required class="w-full mt-2 px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                            <option value="Pokok">Simpanan Pokok</option>
                            <option value="Wajib">Simpanan Wajib</option>
                        </select>
                    </div>

                    <!-- Jumlah Simpanan -->
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 font-bold">Jumlah Simpanan</label>
                        <input type="number" name="jumlah" required
                               class="w-full mt-2 px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white"
                               placeholder="Masukkan jumlah simpanan">
                    </div>

                    <div class="mb-4">
                        <label for="tanggal" class="block text-gray-700 dark:text-gray-200 font-bold">Tanggal Simpanan</label>
                        <input type="date" name="tanggal" id="tanggal" required
                            class="w-full mt-2 px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                    </div>


                    <!-- Tombol Simpan -->
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Simpan Simpanan
                        </button>
                        <a href="{{ route('share.simpan.index') }}"
                            class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
