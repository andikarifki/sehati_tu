<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonPegawai extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     * Karena hanya Nama dan Jabatan, kita daftarkan keduanya di sini.
     */
    protected $fillable = [
        'nama',
        'jabatan',
    ];
}
