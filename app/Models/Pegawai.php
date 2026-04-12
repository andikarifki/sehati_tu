<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Tambahkan ini agar data bisa disimpan
    protected $fillable = [
        'nip',
        'nama',
        'pangkat',
        'golongan',
        'jabatan',
    ];
}
