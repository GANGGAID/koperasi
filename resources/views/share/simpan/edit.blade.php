<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Simpanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('share.simpan.update', $simpan->id) }}" method="POST" class="grid grid-cols-2 gap-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="anggota_id" class="block text-sm font-medium text-gray-300">Anggota</label>
                            <select name="anggota_id" id="anggota_id" class="w-full px-3 py-2 border rounded-lg text-black">
                                <option value="">Pilih Anggota</option>
                                @foreach($anggota as $a)
                                    <option value="{{ $a->id }}" {{ $simpan->anggota_id == $a->id ? 'selected' : '' }}>
                                        {{ $a->nama ?? $a->user->name ?? 'Nama Tidak Ditemukan' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-300">Tanggal Simpanan</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ $simpan->tanggal }}" class="w-full px-3 py-2 border rounded-lg text-black">
                        </div>

                        <div>
                            <label for="jumlah" class="block text-sm font-medium text-gray-300">Jumlah Simpanan</label>
                            <input type="number" name="jumlah" id="jumlah" value="{{ $simpan->jumlah }}" class="w-full px-3 py-2 border rounded-lg text-black">
                        </div>

                        <div>
                            <label for="jenis" class="block text-sm font-medium text-gray-300">Jenis Simpanan</label>
                            <select name="jenis" id="jenis" class="w-full px-3 py-2 border rounded-lg text-black">
                                <option value="Pokok" {{ $simpan->jenis == 'Pokok' ? 'selected' : '' }}>Simpanan Pokok</option>
                                <option value="Wajib" {{ $simpan->jenis == 'Wajib' ? 'selected' : '' }}>Simpanan Wajib</option>
                            </select>
                        </div>

                        <div class="col-span-2 flex justify-center">
                            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">
                                Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
