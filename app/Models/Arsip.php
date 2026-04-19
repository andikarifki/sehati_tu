<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'nomor_surat',
        'tanggal_dokumen',
        'kategori',
        'pihak_terkait',
        'pegawai_id',
        'keterangan',
        'file_path',
    ];

    // Relasi ke Pegawai (Jika kategori SK Pegawai)
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
