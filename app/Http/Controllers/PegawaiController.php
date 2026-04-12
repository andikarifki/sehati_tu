<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PegawaiController extends Controller
{
    // Menampilkan daftar pegawai
    public function index()
    {
        return Inertia::render('Pegawai/Index', [
            'pegawai' => Pegawai::latest()->get(),
        ]);
    }

    // Menyimpan data pegawai baru
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:pegawais,nip|max:18',
            'nama' => 'required|string|max:255',
            'pangkat' => 'required|string',
            'golongan' => 'required|string',
            'jabatan' => 'required|string',
        ]);

        Pegawai::create($request->all());

        return redirect()->back()->with('message', 'Data pegawai berhasil ditambahkan.');
    }

    // Menghapus data pegawai
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()->back()->with('message', 'Data pegawai berhasil dihapus.');
    }
}
