<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        
        if (empty($keyword)) {
            return redirect()->route('dashboard')
                ->with('error', 'Silakan masukkan kata kunci pencarian');
        }

        // Pencarian Surat Masuk
        $suratMasuk = SuratMasuk::where(function($query) use ($keyword) {
            $query->where('nomor_surat', 'LIKE', "%{$keyword}%")
                  ->orWhere('pengirim', 'LIKE', "%{$keyword}%")
                  ->orWhere('perihal', 'LIKE', "%{$keyword}%")
                  ->orWhere('keterangan', 'LIKE', "%{$keyword}%");
        })->latest()->get();

        // Pencarian Surat Keluar
        $suratKeluar = SuratKeluar::where(function($query) use ($keyword) {
            $query->where('nomor_surat', 'LIKE', "%{$keyword}%")
                  ->orWhere('tujuan', 'LIKE', "%{$keyword}%")
                  ->orWhere('perihal', 'LIKE', "%{$keyword}%")
                  ->orWhere('keterangan', 'LIKE', "%{$keyword}%");
        })->latest()->get();

        return view('search.index', compact('suratMasuk', 'suratKeluar', 'keyword'));
    }
}