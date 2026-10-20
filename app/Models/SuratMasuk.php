<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';
    
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tanggal_diterima',
        'pengirim',
        'perihal',
        'keterangan',
        'file_surat',
        'status',
        'dibaca_pada',
        'dibaca_oleh'
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_diterima' => 'date',
        'dibaca_pada' => 'datetime',
    ];

    // Relasi ke User yang membaca surat
    public function pembaca()
    {
        return $this->belongsTo(\App\Models\User::class, 'dibaca_oleh');
    }
}