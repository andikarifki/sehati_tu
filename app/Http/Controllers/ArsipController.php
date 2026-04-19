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
        // 1. Ambil keyword pencarian dari query string (?search=...)
        $search = $request->input('search');

        // 2. Query data arsip
        $query = Arsip::query()->with('pegawai');

        // 3. Logika Pencarian (Jika ada keyword)
        $query->when($search, function ($q, $search) {
            $q->where('judul', 'like', "%{$search}%")
                ->orWhere('nomor_surat', 'like', "%{$search}%")
                ->orWhere('pihak_terkait', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%");
        });

        // 4. Ambil data terbaru dan lakukan mapping untuk URL file
        $arsip = $query->latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'nomor_surat' => $item->nomor_surat,
                'tanggal_dokumen' => $item->tanggal_dokumen,
                'kategori' => $item->kategori,
                'pihak_terkait' => $item->pihak_terkait,
                'file_url' => asset('storage/'.$item->file_path),
            ];
        });

        // 5. Kirim data arsip dan filter pencarian ke Vue
        return Inertia::render('Arsip/Index', [
            'arsip' => $arsip,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    /**
     * Menampilkan form upload
     */
    public function create()
    {
        $pegawai = Pegawai::select('id', 'nama')->get();

        return Inertia::render('Arsip/Create', [
            'pegawai' => $pegawai,
        ]);
    }

    /**
     * Menyimpan data arsip
     */
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
     * Menghapus arsip
     */
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
