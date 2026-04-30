<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Inertia\Inertia;
use Inertia\Response;

class PegawaiController extends Controller
{
    /**
     * Menampilkan daftar pegawai.
     */
    public function index(Request $request): Response
    {
        $search = $request->input('search');

        $pegawai = Pegawai::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            })
            ->orderBy('id', 'asc')
            ->get();

        return Inertia::render('Pegawai/Index', [
            'pegawai' => $pegawai,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    /**
     * Form tambah pegawai.
     */
    public function create(): Response
    {
        return Inertia::render('Pegawai/Create');
    }

    /**
     * Simpan data pegawai baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nip' => 'required|unique:pegawais,nip|max:18',
            'nama' => 'required|string|max:255',
            'pangkat' => 'required|string',
            'golongan' => 'required|string',
            'jabatan' => 'required|string',
        ]);

        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')->with('message', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Form edit pegawai.
     * Menggunakan Route Model Binding (Pegawai $pegawai) menggantikan $id.
     */
    public function edit(Pegawai $pegawai): Response
    {
        return Inertia::render('Pegawai/Edit', [
            'pegawai' => $pegawai,
        ]);
    }

    /**
     * Update data pegawai.
     */
    public function update(Request $request, Pegawai $pegawai): RedirectResponse
    {
        $request->validate([
            // Menggunakan $pegawai->id agar pengecekan unique mengabaikan data ini sendiri
            'nip' => 'required|max:18|unique:pegawais,nip,'.$pegawai->id,
            'nama' => 'required|string|max:255',
            'pangkat' => 'required|string',
            'golongan' => 'required|string',
            'jabatan' => 'required|string',
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('message', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Hapus data pegawai.
     */
    public function destroy(Pegawai $pegawai): RedirectResponse
    {
        $pegawai->delete();

        return redirect()->back()->with('message', 'Data pegawai berhasil dihapus.');
    }

    /**
     * Export data ke PDF.
     */
    public function exportPdf(Request $request): HttpResponse
    {
        $search = $request->input('search');

        $pegawai = Pegawai::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            })
            ->orderBy('id', 'asc')
            ->get();

        $pdf = Pdf::loadView('pdf.pegawai', compact('pegawai'));

        return $pdf->stream('daftar-pegawai.pdf');
    }
}
