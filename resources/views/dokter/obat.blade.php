<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Data Obat') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Tombol Tambah --}}
            <div class="flex justify-end mb-4">
                <button class="bg-blue-500 hover:bg-blue-600 btn btn-primary" type="button"
                        onclick="document.getElementById('modal-tambah-obat').classList.remove('hidden')">
                    Tambah Obat
                </button>
            </div>

            {{-- Tabel Obat --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <table class="min-w-full table-auto border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">Nama Obat</th>
                                <th class="border px-4 py-2">Kemasan</th>
                                <th class="border px-4 py-2">Harga</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obats as $obat)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">{{ $obat->nama_obat }}</td>
                                    <td class="border px-4 py-2">{{ $obat->kemasan }}</td>
                                    <td class="border px-4 py-2">Rp{{ number_format($obat->harga, 0, ',', '.') }}</td>
                                    <td class="border px-4 py-2 space-x-1">
                                        <a href="{{ route('dokter.obat.update', $obat->id) }}"
                                          class="btn btn-success btn-sm">Edit</a><br></br>
                                        <form action="{{ route('dokter.obat.destroy', $obat->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Belum ada data obat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal Tambah Obat --}}
            <div id="modal-tambah-obat" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50 hidden">
                <div class="bg-white w-full max-w-md rounded shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Tambah Obat</h3>
                        <button onclick="document.getElementById('modal-tambah-obat').classList.add('hidden')">&times;</button>
                    </div>
                    <form action="{{ route('dokter.obat.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm text-gray-700">Nama Obat</label>
                            <input type="text" name="nama_obat" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm text-gray-700">Kemasan</label>
                            <input type="text" name="kemasan" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm text-gray-700">Harga</label>
                            <input type="number" name="harga" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="button"
                                    onclick="document.getElementById('modal-tambah-obat').classList.add('hidden')"
                                    class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                                Batal
                            </button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
