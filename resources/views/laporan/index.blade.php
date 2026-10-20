<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Header Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center">
                        <svg class="w-12 h-12 text-blue-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Laporan Persuratan</h3>
                            <p class="text-sm text-gray-600 mt-1">Cetak laporan surat masuk dan surat keluar berdasarkan periode tertentu dalam format PDF</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Pilihan Laporan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Card Laporan Surat Masuk -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Laporan Surat Masuk</h3>
                        <p class="text-sm text-gray-600 mb-6">
                            Cetak laporan surat masuk berdasarkan periode tanggal diterima. Laporan akan menampilkan detail nomor surat, pengirim, perihal, dan status surat.
                        </p>
                        
                        <a href="{{ route('laporan.surat-masuk') }}" 
                           class="inline-flex items-center justify-center w-full px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Buat Laporan Surat Masuk
                        </a>
                    </div>
                </div>

                <!-- Card Laporan Surat Keluar -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Laporan Surat Keluar</h3>
                        <p class="text-sm text-gray-600 mb-6">
                            Cetak laporan surat keluar berdasarkan periode tanggal surat. Laporan akan menampilkan detail nomor surat, tujuan, perihal, dan status surat.
                        </p>
                        
                        <a href="{{ route('laporan.surat-keluar') }}" 
                           class="inline-flex items-center justify-center w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Buat Laporan Surat Keluar
                        </a>
                    </div>
                </div>

            </div>

            <!-- Info Tambahan -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mt-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>Tips:</strong> Setelah memilih periode tanggal, Anda dapat melihat preview laporan sebelum mengunduhnya dalam format PDF.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>