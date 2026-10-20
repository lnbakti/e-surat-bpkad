<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // Halaman Menu Laporan
    public function index()
    {
        return view('laporan.index');
    }

    // Form Laporan Surat Masuk
    public function suratMasuk()
    {
        return view('laporan.surat-masuk');
    }

    // Preview Laporan Surat Masuk
    public function previewSuratMasuk(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $data = SuratMasuk::whereBetween('tanggal_diterima', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('tanggal_diterima', 'desc')
            ->get();

        return view('laporan.preview-surat-masuk', compact('data', 'tanggalAwal', 'tanggalAkhir'));
    }

    // Download PDF Laporan Surat Masuk
    public function downloadSuratMasuk(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $data = SuratMasuk::whereBetween('tanggal_diterima', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('tanggal_diterima', 'desc')
            ->get();

        $pdf = Pdf::loadView('laporan.pdf-surat-masuk', compact('data', 'tanggalAwal', 'tanggalAkhir'));
        
        $filename = 'Laporan_Surat_Masuk_' . date('Ymd_His') . '.pdf';
        
        return $pdf->download($filename);
    }

    // Form Laporan Surat Keluar
    public function suratKeluar()
    {
        return view('laporan.surat-keluar');
    }

    // Preview Laporan Surat Keluar
    public function previewSuratKeluar(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $data = SuratKeluar::whereBetween('tanggal_surat', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('tanggal_surat', 'desc')
            ->get();

        return view('laporan.preview-surat-keluar', compact('data', 'tanggalAwal', 'tanggalAkhir'));
    }

    // Download PDF Laporan Surat Keluar
    public function downloadSuratKeluar(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $data = SuratKeluar::whereBetween('tanggal_surat', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('tanggal_surat', 'desc')
            ->get();

        $pdf = Pdf::loadView('laporan.pdf-surat-keluar', compact('data', 'tanggalAwal', 'tanggalAkhir'));
        
        $filename = 'Laporan_Surat_Keluar_' . date('Ymd_His') . '.pdf';
        
        return $pdf->download($filename);
    }
}