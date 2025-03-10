<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pinjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black">
                    <form action="{{ route('share.pinjam.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="anggota_id" class="block text-sm font-medium text-white">Anggota</label>
                                <select name="anggota_id" id="anggota_id" class="w-full px-3 py-2 border rounded-lg text-black">
                                    <option value="">Pilih Anggota</option>
                                    @foreach($anggota as $a)
                                        <option value="{{ $a->id }}">
                                            {{ $a->nama ?? $a->user->name ?? 'Nama Tidak Ditemukan' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="jumlah" class="block text-sm font-medium text-white">Jumlah Pinjaman</label>
                                <input type="number" name="jumlah" id="jumlah" class="w-full border-gray-300 rounded p-2 text-black" required>
                            </div>

                            <div>
                                <label for="bunga" class="block text-sm font-medium text-white">Bunga (%)</label>
                                <input type="number" name="bunga" id="bunga" class="w-full border-gray-300 rounded p-2 text-black" step="0.01" required>
                            </div>

                            <div>
                                <label for="tenor" class="block text-sm font-medium text-white">Tenor (bulan)</label>
                                <input type="number" name="tenor" id="tenor" class="w-full border-gray-300 rounded p-2 text-black" required>
                            </div>

                            <div>
                                <label for="tanggal_pinjam" class="block text-sm font-medium text-white">Tanggal Pinjam</label>
                                <input type="date" name="tanggal_pinjam" class="w-full border-gray-300 rounded p-2 text-black" required>
                            </div>

                            <div>
                                <label for="tanggal_jatuh_tempo" class="block text-sm font-medium text-white">Tanggal Jatuh Tempo</label>
                                <input type="date" name="tanggal_jatuh_tempo" class="w-full border-gray-300 rounded p-2 text-black" required>
                            </div>

                            <div>
                                <label for="tanggal_pengajuan" class="block text-sm font-medium text-white">Tanggal Pengajuan</label>
                                <input type="date" name="tanggal_pengajuan" class="w-full border-gray-300 rounded p-2 text-black" required>
                            </div>

                            <div>
                                <label for="tanggal_persetujuan" class="block text-sm font-medium text-white">Tanggal Persetujuan</label>
                                <input type="date" name="tanggal_persetujuan" class="w-full border-gray-300 rounded p-2 text-black">
                            </div>
                        </div>

                        <div class="flex space-x-4 mt-6">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
                            <a href="{{ route('share.pinjam.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                            <button type="button" id="cekSimulasi" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mr-2">Cek Simulasi</button>
                        </div>
                    </form>
                    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                $('#cekSimulasi').on('click', function () {
                                    const jumlah = parseFloat($('#jumlah').val());
                                    const bunga = parseFloat($('#bunga').val());
                                    const tenor = parseInt($('#tenor').val());

                                    if (!jumlah || !bunga || !tenor || jumlah <= 0 || bunga < 0 || tenor <= 0) {
                                        alert('Mohon isi semua data dengan benar.');
                                        return;
                                    }

                                    const url = "{{ route('share.pinjam.simulasi') }}" + `?jumlah=${jumlah}&bunga=${bunga}&tenor=${tenor}`;
                                    window.open(url, '_blank');
                                });
                            });
                        </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
