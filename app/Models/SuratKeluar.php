<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';
    
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tujuan',
        'perihal',
        'keterangan',
        'file_surat',
        'status'
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];
}