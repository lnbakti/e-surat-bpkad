<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Pencarian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Form Pencarian -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('search') }}" method="GET" class="flex gap-3">
                        <div class="flex-1">
                            <input type="text" 
                                   name="keyword" 
                                   placeholder="Cari surat berdasarkan nomor, pengirim/tujuan, atau perihal..." 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   value="{{ $keyword }}">
                        </div>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center px-6 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-white hover:bg-gray-600">
                            Kembali
                        </a>
                    </form>
                </div>
            </div>

            <!-- Info Hasil -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            Ditemukan <strong>{{ $suratMasuk->count() + $suratKeluar->count() }}</strong> hasil untuk kata kunci: <strong>"{{ $keyword }}"</strong>
                            <br>
                            <span class="text-xs">{{ $suratMasuk->count() }} Surat Masuk | {{ $suratKeluar->count() }} Surat Keluar</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Hasil Surat Masuk -->
            @if($suratMasuk->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-2 h-8 bg-green-500 rounded mr-3"></div>
                        <h3 class="text-lg font-semibold text-gray-800">Surat Masuk ({{ $suratMasuk->count() }})</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Surat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pengirim</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Perihal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($suratMasuk as $surat)
                                <tr class="hover:bg-green-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        {!! str_ireplace($keyword, '<mark class="bg-yellow-200 px-1 rounded">' . $keyword . '</mark>', $surat->nomor_surat) !!}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {!! str_ireplace($keyword, '<mark class="bg-yellow-200 px-1 rounded">' . $keyword . '</mark>', $surat->pengirim) !!}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        {!! str_ireplace($keyword, '<mark class="bg-yellow-200 px-1 rounded">' . $keyword . '</mark>', Str::limit($surat->perihal, 40)) !!}
                                    </td>
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
                                           class="inline-flex items-center px-3 py-1 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Hasil Surat Keluar -->
            @if($suratKeluar->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-2 h-8 bg-blue-500 rounded mr-3"></div>
                        <h3 class="text-lg font-semibold text-gray-800">Surat Keluar ({{ $suratKeluar->count() }})</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Surat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tujuan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Perihal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($suratKeluar as $surat)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        {!! str_ireplace($keyword, '<mark class="bg-yellow-200 px-1 rounded">' . $keyword . '</mark>', $surat->nomor_surat) !!}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {!! str_ireplace($keyword, '<mark class="bg-yellow-200 px-1 rounded">' . $keyword . '</mark>', $surat->tujuan) !!}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        {!! str_ireplace($keyword, '<mark class="bg-yellow-200 px-1 rounded">' . $keyword . '</mark>', Str::limit($surat->perihal, 40)) !!}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $surat->tanggal_surat->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($surat->status == 'draft') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ ucfirst($surat->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('surat-keluar.show', $surat) }}" 
                                           class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium rounded">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Jika Tidak Ada Hasil -->
            @if($suratMasuk->count() == 0 && $suratKeluar->count() == 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-center">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada hasil ditemukan</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Tidak ditemukan surat dengan kata kunci "<strong>{{ $keyword }}</strong>"
                    </p>
                    <p class="mt-1 text-xs text-gray-400">
                        Coba gunakan kata kunci yang berbeda
                    </p>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>