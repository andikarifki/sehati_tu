<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil keyword pencarian dari query string (?search=...)
        $search = $request->input('search');

        // 2. Query data pegawai dengan pengkondisian (if search exists)
        $pegawai = Pegawai::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            })
            ->orderBy('id', 'asc') // Mengurutkan ID terbaru di atas
            ->get();

        // 3. Render ke Vue dengan mengirim data pegawai dan status filter saat ini
        return Inertia::render('Pegawai/Index', [
            'pegawai' => $pegawai,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Pegawai/Create');
    }

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

        return redirect()->route('pegawai.index')->with('message', 'Data pegawai berhasil ditambahkan.');
    }

    // 1. TAMBAHKAN INI: Menampilkan form edit dengan data pegawai
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        return Inertia::render('Pegawai/Edit', [
            'pegawai' => $pegawai,
        ]);
    }

    // 2. TAMBAHKAN INI: Memproses perubahan data
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            // NIP unik kecuali untuk ID pegawai ini sendiri
            'nip' => 'required|max:18|unique:pegawais,nip,'.$id,
            'nama' => 'required|string|max:255',
            'pangkat' => 'required|string',
            'golongan' => 'required|string',
            'jabatan' => 'required|string',
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('message', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->back()->with('message', 'Data pegawai berhasil dihapus.');
    }
}
