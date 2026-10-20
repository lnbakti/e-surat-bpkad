<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Surat Keluar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('surat-keluar.update', $suratKeluar) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="nomor_surat">
                                Nomor Surat <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat', $suratKeluar->nomor_surat) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomor_surat') border-red-500 @enderror">
                            @error('nomor_surat')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_surat">
                                Tanggal Surat <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_surat" id="tanggal_surat" value="{{ old('tanggal_surat', $suratKeluar->tanggal_surat->format('Y-m-d')) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_surat') border-red-500 @enderror">
                            @error('tanggal_surat')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="tujuan">
                                Tujuan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="tujuan" id="tujuan" value="{{ old('tujuan', $suratKeluar->tujuan) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tujuan') border-red-500 @enderror">
                            @error('tujuan')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="perihal">
                                Perihal <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="perihal" id="perihal" value="{{ old('perihal', $suratKeluar->perihal) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('perihal') border-red-500 @enderror">
                            @error('perihal')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="keterangan">
                                Keterangan
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="4"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('keterangan') border-red-500 @enderror">{{ old('keterangan', $suratKeluar->keterangan) }}</textarea>
                            @error('keterangan')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror">
                                <option value="">Pilih Status</option>
                                <option value="draft" {{ old('status', $suratKeluar->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="terkirim" {{ old('status', $suratKeluar->status) == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="file_surat">
                                File Surat (PDF, DOC, DOCX, JPG, PNG - Max: 2MB)
                            </label>
                            @if($suratKeluar->file_surat)
                                <p class="text-sm text-gray-600 mb-2">File saat ini: 
                                    <a href="{{ Storage::url($suratKeluar->file_surat) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                                </p>
                            @endif
                            <input type="file" name="file_surat" id="file_surat"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('file_surat') border-red-500 @enderror">
                            @error('file_surat')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('surat-keluar.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Kembali
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>