<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('share.anggota.update', $anggota->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Pilih User -->
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-200">Pilih User</label>
                            <select id="user_id" name="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm js-example-basic-single" disabled>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $anggota->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} - {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-gray-400">* User tidak bisa diubah setelah ditetapkan</small>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-200">Alamat</label>
                            <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $anggota->alamat) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-200">Telepon</label>
                            <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $anggota->telepon) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-200">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="Laki-laki" {{ $anggota->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $anggota->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Nama Pewaris -->
                        <div>
                            <label for="nama_pewaris" class="block text-sm font-medium text-gray-200">Nama Pewaris</label>
                            <input type="text" id="nama_pewaris" name="nama_pewaris" value="{{ old('nama_pewaris', $anggota->nama_pewaris) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Tanggal Masuk -->
                        <div>
                            <label for="tanggal_masuk" class="block text-sm font-medium text-gray-200">Tanggal Masuk</label>
                            <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', $anggota->tanggal_masuk) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Tanggal Keluar -->
                        <div>
                            <label for="tanggal_keluar" class="block text-sm font-medium text-gray-200">Tanggal Keluar</label>
                            <input type="date" id="tanggal_keluar" name="tanggal_keluar" value="{{ old('tanggal_keluar', $anggota->tanggal_keluar) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-6 text-center">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Perbarui
                        </button>
                        <a href="{{ route('share.anggota.index') }}" class="ml-4 text-gray-300 hover:underline">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    @endpush

    @push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    @endpush

</x-app-layout>
