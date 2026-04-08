<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Siswa;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    /**
     * SISWA: Tampilkan form pengaduan
     */
    public function siswaForm()
    {
        $kategoris = Kategori::all();
        return view('siswa.pengaduan', compact('kategoris'));
    }

    /**
     * SISWA: Simpan pengaduan
     */
    public function siswaSimpan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'prioritas' => 'required|in:Rendah,Sedang,Tinggi',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        // Get current siswa
        $siswa = Auth::guard('siswa')->user();

        if (!$siswa) {
            return back()->with('error', 'Anda harus login sebagai siswa');
        }

        // Upload foto if exists
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduans', 'public');
        }

        // Create pengaduan
        $pengaduan = Pengaduan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'prioritas' => $request->prioritas,
            'status' => 'menunggu',
            'siswa_id' => $siswa->id,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('siswa.riwayat')->with('success', 'Pengaduan berhasil dikirim');
    }

    /**
     * SISWA: Tampilkan riwayat pengaduan siswa
     */
    public function siswaRiwayat()
    {
        $siswa = Auth::guard('siswa')->user();

        if (!$siswa) {
            return back()->with('error', 'Anda harus login sebagai siswa');
        }

        $pengaduans = Pengaduan::where('siswa_id', $siswa->id)
            ->with('tanggapans')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.riwayat', compact('pengaduans'));
    }

    /**
     * ADMIN: Tampilkan semua pengaduan
     */
    public function index()
    {
        $pengaduans = Pengaduan::with(['siswa', 'tanggapans'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pengaduan', compact('pengaduans'));
    }

    /**
     * ADMIN: Simpan tanggapan untuk pengaduan
     */
    public function simpanTanggapan(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        // Create tanggapan
        Tanggapan::create([
            'pengaduan_id' => $pengaduan->id,
            'isi' => $request->isi,
        ]);

        // Update status pengaduan to responded if still pending
        if ($pengaduan->status === 'menunggu') {
            $pengaduan->update(['status' => 'diproses']);
        }

        return back()->with('success', 'Tanggapan berhasil dikirim');
    }
}
