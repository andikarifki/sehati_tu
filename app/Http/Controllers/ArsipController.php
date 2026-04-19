<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ArsipController extends Controller
{
    /**
     * Menampilkan daftar arsip
     */
    public function index()
    {
        // Mengambil data arsip terbaru, sertakan data pegawai jika ada relasinya
        $arsip = Arsip::with('pegawai')->latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'nomor_surat' => $item->nomor_surat,
                'tanggal_dokumen' => $item->tanggal_dokumen,
                'kategori' => $item->kategori,
                'pihak_terkait' => $item->pihak_terkait,
                // Mengambil URL file agar bisa dibuka di browser
                'file_url' => asset('storage/'.$item->file_path),
            ];
        });

        return Inertia::render('Arsip/Index', [
            'arsip' => $arsip,
        ]);
    }

    /**
     * Menampilkan form upload
     */
    public function create()
    {
        // Ambil data pegawai untuk isi dropdown di form
        $pegawai = Pegawai::select('id', 'nama')->get();

        return Inertia::render('Arsip/Create', [
            'pegawai' => $pegawai,
        ]);
    }

    /**
     * Menyimpan data arsip ke database dan file ke storage
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'judul' => 'required|string|max:255',
            'nomor_surat' => 'nullable|string|max:100',
            'tanggal_dokumen' => 'required|date',
            'kategori' => 'required|string',
            'pihak_terkait' => 'required|string',
            'file' => 'required|mimes:pdf|max:2048', // Wajib PDF, Maks 2MB
        ]);

        // 2. Proses Upload File
        $filePath = null;
        if ($request->hasFile('file')) {
            // Simpan di folder: public/arsip/2026/...
            $filePath = $request->file('file')->store('arsip/'.date('Y'), 'public');
        }

        // 3. Simpan ke Database
        Arsip::create([
            'judul' => $request->judul,
            'nomor_surat' => $request->nomor_surat,
            'tanggal_dokumen' => $request->tanggal_dokumen,
            'kategori' => $request->kategori,
            'pihak_terkait' => $request->pihak_terkait,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
            // Jika pilih pegawai, simpan ID-nya (opsional)
            'pegawai_id' => $request->pegawai_id ?? null,
        ]);

        return redirect()->route('arsip.index')->with('success', 'Dokumen berhasil diarsipkan.');
    }

    /**
     * Menghapus arsip dan filenya
     */
    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);

        // Hapus file fisik dari storage agar tidak memenuhi server
        if (Storage::disk('public')->exists($arsip->file_path)) {
            Storage::disk('public')->delete($arsip->file_path);
        }

        $arsip->delete();

        return redirect()->back()->with('success', 'Arsip berhasil dihapus.');
    }
}
