<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{

    // TAMPILKAN DATA SISWA
    public function index()
    {
        $siswa = Siswa::all();

        return view('admin.siswa', compact('siswa'));
    }



    // FORM TAMBAH SISWA
    public function create()
    {
        return view('admin.tambah_siswa');
    }



    // SIMPAN SISWA KE DATABASE
    public function store(Request $request)
    {

        // validasi
        $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas',
            'kelas' => 'required',
            'password' => 'required',
        ]);



        // simpan ke database
        Siswa::create([

            'nama' => $request->nama,

            'nis' => $request->nis,

            'kelas' => $request->kelas,

            'password' => Hash::make($request->password)

        ]);



        return redirect()->route('admin.siswa')
            ->with('success', 'Siswa berhasil ditambahkan!');

    }


}
