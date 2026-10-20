<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSuratMasuk = SuratMasuk::count();
        $totalSuratKeluar = SuratKeluar::count();
        $suratMasukBelumDibaca = SuratMasuk::where('status', 'belum_dibaca')->count();
        $suratKeluarDraft = SuratKeluar::where('status', 'draft')->count();
        
        $recentSuratMasuk = SuratMasuk::latest()->take(5)->get();
        $recentSuratKeluar = SuratKeluar::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalSuratMasuk',
            'totalSuratKeluar',
            'suratMasukBelumDibaca',
            'suratKeluarDraft',
            'recentSuratMasuk',
            'recentSuratKeluar'
        ));
    }
}