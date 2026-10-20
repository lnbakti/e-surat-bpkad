<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Surat Masuk') }}
            </h2>
            <a href="{{ route('surat-masuk.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Surat Masuk
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Surat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pengirim</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Perihal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl. Diterima</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($suratMasuk as $index => $surat)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $suratMasuk->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $surat->nomor_surat }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $surat->pengirim }}</td>
                                    <td class="px-6 py-4 text-sm">{{ Str::limit($surat->perihal, 40) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $surat->tanggal_diterima->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($surat->status == 'belum_dibaca') bg-red-100 text-red-800
                                            @elseif($surat->status == 'sudah_dibaca') bg-blue-100 text-blue-800
                                            @elseif($surat->status == 'diproses') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $surat->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('surat-masuk.show', $surat) }}" 
                                        class="text-blue-600 hover:text-blue-900 mr-3 inline-flex items-center">
                                            Lihat
                                            @if($surat->status === 'belum_dibaca')
                                                <span class="ml-1 inline-flex items-center justify-center w-2 h-2 text-xs font-bold text-white bg-red-500 rounded-full"></span>
                                            @endif
                                        </a>
                                        <a href="{{ route('surat-masuk.edit', $surat) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('surat-masuk.destroy', $surat) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data surat masuk</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $suratMasuk->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>