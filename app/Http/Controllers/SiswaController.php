<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = Siswa::all();
        return view('admin.siswa', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tambah_siswa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis',
            'kelas' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.siswa')->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('admin.siswa-detail', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('admin.edit-siswa', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis,' . $siswa->id,
            'kelas' => 'required|string',
        ]);

        $data = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa')->with('success', 'Siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('admin.siswa')->with('success', 'Siswa berhasil dihapus');
    }
}
