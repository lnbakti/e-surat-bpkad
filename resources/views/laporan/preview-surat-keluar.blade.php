<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Preview Laporan Surat Keluar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Header Preview -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Preview Laporan Surat Keluar</h3>
                                <p class="text-sm text-gray-600">
                                    Periode: {{ \Carbon\Carbon::parse($tanggalAwal)->format('d F Y') }} - {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d F Y') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('laporan.surat-keluar') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                            
                            <form action="{{ route('laporan.surat-keluar.download') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="tanggal_awal" value="{{ $tanggalAwal }}">
                                <input type="hidden" name="tanggal_akhir" value="{{ $tanggalAkhir }}">
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download PDF
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Jumlah Data -->
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            Ditemukan <strong>{{ $data->count() }}</strong> surat keluar dalam periode yang dipilih.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Preview Laporan -->
            @if($data->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    
                    <!-- Header Laporan (Preview) -->
                    <div class="text-center mb-8 border-b-2 border-gray-300 pb-6">
                        <div class="flex items-center justify-center mb-4">
                            <img src="{{ asset('images/logo-kuningan.png') }}" alt="Logo BPKAD" class=" h-20 mr-4">
                            <div class="text-center">
                                <h1 class="text-xl font-bold text-gray-800 mt-4">LAPORAN SURAT KELUAR</h1>
                                <h1 class="text-2xl font-bold text-gray-800">BADAN PENGELOLA KEUANGAN DAN ASET DAERAH</h1>
                                <p class="text-xs text-gray-500">Jl. Siliwangi No. 88, Kelurahan Purwawinangun, Kecamatan Kuningan, Kabupaten Kuningan, Jawa Barat 45512</p>
                                <p class="text-sm text-gray-600">
                                    Periode: {{ \Carbon\Carbon::parse($tanggalAwal)->format('d F Y') }} - {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d F Y') }}
                                </p>
                            </div>
                        </div> 
                    </div>

                    <!-- Tabel Data -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700">No</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700">Nomor Surat</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700">Tanggal Surat</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700">Tujuan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700">Perihal</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-xs font-semibold text-gray-700">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $surat)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $index + 1 }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $surat->nomor_surat }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $surat->tanggal_surat->format('d/m/Y') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $surat->tujuan }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">{{ $surat->perihal }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                                        <span class="px-2 py-1 text-xs font-semibold rounded 
                                            @if($surat->status == 'draft') bg-yellow-100 text-yellow-800
                                            @else($surat->status == 'terkirim') bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $surat->status)) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer Preview -->
                    <div class="mt-8 pt-6 border-t border-gray-300">
                        <div class="flex justify-between items-start">
                            <div class="text-sm text-gray-600">
                                <p><strong>Total Surat:</strong> {{ $data->count() }} surat</p>
                                <p class="mt-2 text-xs">Dicetak pada: {{ now()->format('d F Y, H:i') }} WIB</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-700 mb-16">Mengetahui,</p>
                                <br>
                                <p class="text-sm text-gray-700 font-semibold">Kepala BPKAD</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-center">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak Ada Data</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Tidak ada surat keluar dalam periode yang dipilih.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('laporan.surat-keluar') }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg">
                            Pilih Periode Lain
                        </a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>