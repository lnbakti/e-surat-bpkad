<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Surat Keluar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Surat</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nomor Surat</p>
                                <p class="text-base text-gray-900">{{ $suratKeluar->nomor_surat }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal Surat</p>
                                <p class="text-base text-gray-900">{{ $suratKeluar->tanggal_surat->format('d F Y') }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500">Tujuan</p>
                                <p class="text-base text-gray-900">{{ $suratKeluar->tujuan }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">Perihal</p>
                                <p class="text-base text-gray-900">{{ $suratKeluar->perihal }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">Keterangan</p>
                                <p class="text-base text-gray-900">{{ $suratKeluar->keterangan ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($suratKeluar->status == 'draft') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($suratKeluar->status) }}
                                </span>
                            </div>

                            @if($suratKeluar->file_surat)
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500 mb-2">File Surat</p>
                                <a href="{{ Storage::url($suratKeluar->file_surat) }}" target="_blank" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white text-sm font-medium rounded">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat File
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t">
                        <a href="{{ route('surat-keluar.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                        <div class="space-x-2">
                            <a href="{{ route('surat-keluar.edit', $suratKeluar) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('surat-keluar.destroy', $suratKeluar) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin menghapus surat ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>