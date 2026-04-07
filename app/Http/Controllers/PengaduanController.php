<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    // Admin - Tampilkan semua pengaduan
    public function index()
    {
        $pengaduans = Pengaduan::with(['siswa', 'tanggapans'])->latest()->get();
        return view('admin.pengaduan', compact('pengaduans'));
    }

    // Admin - Simpan tanggapan dan update status
    public function simpanTanggapan(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
            'status' => 'required|in:menunggu,diproses,selesai'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        // Simpan tanggapan
        Tanggapan::create([
            'pengaduan_id' => $id,
            'isi' => $request->isi
        ]);

        // Update status pengaduan
        $pengaduan->update(['status' => $request->status]);

        return back()->with('success', 'Tanggapan berhasil dikirim dan status diperbarui!');
    }

    // Siswa - Form pengaduan
    public function siswaForm()
    {
        return view('siswa.pengaduan');
    }

    // Siswa - Simpan pengaduan
    public function siswaSimpan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'prioritas' => 'required|string|in:Rendah,Sedang,Tinggi',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'prioritas' => $request->prioritas,
            'status' => 'menunggu',
            'siswa_id' => Auth::guard('siswa')->id(),
            'foto' => $fotoPath
        ]);

        return redirect()->route('siswa.riwayat')
            ->with('success', 'Pengaduan berhasil dikirim!');
    }

    // Siswa - Riwayat pengaduan
    public function siswaRiwayat()
    {
        $siswaId = Auth::guard('siswa')->id();
        $pengaduans = Pengaduan::with('tanggapans')->where('siswa_id', $siswaId)->latest()->get();

        return view('siswa.riwayat', compact('pengaduans'));
    }
}
