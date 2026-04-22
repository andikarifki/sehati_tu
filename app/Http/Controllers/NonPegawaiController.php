<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\NonPegawai;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NonPegawaiController extends Controller
{
    /**
     * Tampilkan Daftar Non-Pegawai
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $nonPegawai = NonPegawai::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return Inertia::render('NonPegawai/Index', [
            'nonPegawai' => $nonPegawai,
            'filters' => ['search' => $search],
            // Kita ambil juga total arsip untuk info di header jika perlu
            'totalArsip' => Arsip::count(),
        ]);
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        return Inertia::render('NonPegawai/Create');
    }

    /**
     * Simpan Data
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        NonPegawai::create($request->all());

        return redirect()->route('non-pegawai.index')
            ->with('success', 'Data Non-Pegawai berhasil ditambahkan.');
    }

    /**
     * Form Edit
     */
    public function edit($id)
    {
        $nonPegawai = NonPegawai::findOrFail($id);

        return Inertia::render('NonPegawai/Edit', [
            'nonPegawai' => $nonPegawai,
        ]);
    }

    /**
     * Update Data
     */
    public function update(Request $request, $id)
    {
        $nonPegawai = NonPegawai::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        $nonPegawai->update($request->all());

        return redirect()->route('non-pegawai.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Hapus Data
     */
    public function destroy($id)
    {
        $nonPegawai = NonPegawai::findOrFail($id);
        $nonPegawai->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
