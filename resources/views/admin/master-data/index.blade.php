<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Master Data Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">Daftar Pengguna</h3>
                        <a href="{{ route('register') }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                            Tambah Pengguna
                        </a>
                    </div>

                    <!-- Membuat tabel responsif -->
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-3 text-left">No</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left">Nama</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left">Email</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left">Role</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left">Tanggal Bergabung</th>
                                    <th class="border border-gray-300 px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr class="hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-3 text-left">
                                            {{ $users->firstItem() + $loop->index }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-3">{{ $user->name }}</td>
                                        <td class="border border-gray-300 px-4 py-3">{{ $user->email }}</td>
                                        <td class="border border-gray-300 px-4 py-3 capitalize">{{ $user->role }}</td>
                                        <td class="border border-gray-300 px-4 py-3">{{ $user->created_at->format('d M Y') }}</td>
                                        <td class="border border-gray-300 px-4 py-3 text-center">
                                            <a href="#" class="text-blue-500 hover:underline">Edit</a> |
                                            <a href="#" class="text-red-500 hover:underline">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination jika menggunakan paginate -->
                    @if ($users->hasPages())
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
