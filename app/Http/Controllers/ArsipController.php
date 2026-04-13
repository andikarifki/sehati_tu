<?php

namespace App\Http\Controllers;

use Inertia\Inertia; // Pastikan baris ini benar

class ArsipController extends Controller
{
    public function index()
    {
        // Data dummy dengan struktur yang lebih ramping
        $dataDummy = [
            [
                'id' => 1,
                'judul' => 'SK Kenaikan Pangkat 2024',
                'nomor_surat' => '800/123/BAPELKUM/2024',
                'kategori' => 'SK Pegawai',
                'pihak_terkait' => 'Budi Santoso, S.H.',
                'file_url' => '#',
            ],
            [
                'id' => 2,
                'judul' => 'Undangan Rapat Koordinasi Kanwil',
                'nomor_surat' => 'W13.UM.01.01-442',
                'kategori' => 'Surat Masuk',
                'pihak_terkait' => 'Kanwil Kemenkumham Jateng',
                'file_url' => '#',
            ],
            [
                'id' => 3,
                'judul' => 'Nota Dinas Pengadaan ATK TW II',
                'nomor_surat' => 'B/ND-12/Bapelkum/IV/2026',
                'kategori' => 'Nota Dinas',
                'pihak_terkait' => 'Subbagian Tata Usaha',
                'file_url' => '#',
            ],
            [
                'id' => 4,
                'judul' => 'Surat Pengiriman Laporan Bulanan',
                'nomor_surat' => '800/556/Bapelkum/2026',
                'kategori' => 'Surat Keluar',
                'pihak_terkait' => 'BPSDM Hukum dan HAM',
                'file_url' => '#',
            ],
        ];

        return Inertia::render('Arsip/Index', [
            'arsip' => $dataDummy,
        ]);
    }

    public function create()
    {
        // Data dummy pegawai agar dropdown di halaman Create muncul isinya
        $pegawaiDummy = [
            ['id' => 1, 'nama' => 'Budi Santoso, S.H.'],
            ['id' => 2, 'nama' => 'Siti Aminah, M.H.'],
            ['id' => 3, 'nama' => 'Eko Prasetyo, S.Sos.'],
            ['id' => 4, 'nama' => 'Dian Sastro, M.Pd.'],
        ];

        return Inertia::render('Arsip/Create', [
            'pegawai' => $pegawaiDummy,
        ]);
    }
}
