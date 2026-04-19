<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Nama Dokumen
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_dokumen');

            // Kategori: Surat Masuk, Surat Keluar, SK Pegawai, Nota Dinas, dll.
            $table->string('kategori');

            // Kolom fleksibel untuk Asal/Tujuan/Nama Pegawai
            $table->string('pihak_terkait');

            // Jika arsip ini khusus milik pegawai tertentu (Opsional untuk relasi)
            $table->foreignId('pegawai_id')->nullable()->constrained('pegawais')->onDelete('set null');

            $table->text('keterangan')->nullable(); // Ringkasan isi surat
            $table->string('file_path'); // Lokasi penyimpanan file PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};
