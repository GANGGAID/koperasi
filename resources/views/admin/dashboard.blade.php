<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Baris 1: Total Anggota & Jumlah Simpanan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total Anggota</h3>
                    <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $totalAnggota }} Anggota</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Jumlah Simpanan</h3>
                    <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Baris 2: Total Pinjaman -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total Pinjaman</h3>
                    <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">Rp {{ number_format($totalPinjaman, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
