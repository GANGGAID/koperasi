{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Anggota Koperasi') }}
        </h2>
        <form method="POST" action="{{ route('admin.anggota.create') }}">
            @csrf
    </x-slot>

            <!-- Alamat -->
            <div>
                <x-input-label for="alamat" :value="__('Alamat')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('alamat')" required autofocus autocomplete="alamat" />
                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            </div>

            <!-- Telepon -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Telepon')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('telepon')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
            </div>

            <!-- Jenis Kelamin -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Jenis_Kelamin')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('jenis_kelamin')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
            </div>

            <!-- Nama Pewaris -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Nama_Pewaris')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('nama_pewaris')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('nama_pewaris')" class="mt-2" />
            </div>

            <!-- Tanggal masuk -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Tanggal_Masuk')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('tanggal_masuk')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('tanggal_masuk')" class="mt-2" />
            </div>

            <!-- Tanggal Keluar -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Tanggal_Keluar')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('tanggal_keluar')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('tanggal_keluar')" class="mt-2" />
            </div>

                <x-primary-button class="ms-4">
                    {{ __('admin.anggota.create') }}
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout> --}}
