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
     * Menampilkan daftar arsip dengan fitur pencarian
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Arsip::query()->with('pegawai');

        $query->when($search, function ($q, $search) {
            $q->where('judul', 'like', "%{$search}%")
                ->orWhere('nomor_surat', 'like', "%{$search}%")
                ->orWhere('pihak_terkait', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%");
        });

        $arsip = $query->latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'nomor_surat' => $item->nomor_surat,
                'tanggal_dokumen' => $item->tanggal_dokumen,
                'kategori' => $item->kategori,
                'pihak_terkait' => $item->pihak_terkait,
                'file_path' => $item->file_path, // Ditambahkan untuk kebutuhan edit
                'file_url' => asset('storage/'.$item->file_path),
            ];
        });

        return Inertia::render('Arsip/Index', [
            'arsip' => $arsip,
            'filters' => ['search' => $search],
        ]);
    }

    public function create()
    {
        $pegawai = Pegawai::select('id', 'nama')->get();

        return Inertia::render('Arsip/Create', ['pegawai' => $pegawai]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'nomor_surat' => 'nullable|string|max:100',
            'tanggal_dokumen' => 'required|date',
            'kategori' => 'required|string',
            'pihak_terkait' => 'required|string',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('arsip/'.date('Y'), 'public');
        }

        Arsip::create([
            'judul' => $request->judul,
            'nomor_surat' => $request->nomor_surat,
            'tanggal_dokumen' => $request->tanggal_dokumen,
            'kategori' => $request->kategori,
            'pihak_terkait' => $request->pihak_terkait,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
            'pegawai_id' => $request->pegawai_id ?? null,
        ]);

        return redirect()->route('arsip.index')->with('success', 'Dokumen berhasil diarsipkan.');
    }

    /**
     * Menampilkan form edit (BARU)
     */
    public function edit($id)
    {
        $arsip = Arsip::findOrFail($id);
        $pegawai = Pegawai::select('id', 'nama')->get();

        return Inertia::render('Arsip/Edit', [
            'arsip' => $arsip,
            'pegawai' => $pegawai,
        ]);
    }

    /**
     * Memperbarui data arsip (BARU)
     */
    public function update(Request $request, $id)
    {
        $arsip = Arsip::findOrFail($id);

        // Validasi (file dibuat nullable karena tidak wajib ganti file saat edit)
        $request->validate([
            'judul' => 'required|string|max:255',
            'nomor_surat' => 'nullable|string|max:100',
            'tanggal_dokumen' => 'required|date',
            'kategori' => 'required|string',
            'pihak_terkait' => 'required|string',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'nomor_surat' => $request->nomor_surat,
            'tanggal_dokumen' => $request->tanggal_dokumen,
            'kategori' => $request->kategori,
            'pihak_terkait' => $request->pihak_terkait,
            'keterangan' => $request->keterangan,
            'pegawai_id' => $request->pegawai_id ?? null,
        ];

        // Logika Ganti File
        if ($request->hasFile('file')) {
            // 1. Hapus file lama dari storage
            if ($arsip->file_path && Storage::disk('public')->exists($arsip->file_path)) {
                Storage::disk('public')->delete($arsip->file_path);
            }
            // 2. Upload file baru
            $data['file_path'] = $request->file('file')->store('arsip/'.date('Y'), 'public');
        }

        $arsip->update($data);

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);

        if ($arsip->file_path && Storage::disk('public')->exists($arsip->file_path)) {
            Storage::disk('public')->delete($arsip->file_path);
        }

        $arsip->delete();

        return redirect()->back()->with('success', 'Arsip berhasil dihapus.');
    }
}
