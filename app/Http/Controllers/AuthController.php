<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $userType = $request->user_type;

        if ($userType == 'admin') {
            if (!$request->filled('username') || !$request->filled('password')) {
                return back()->withInput($request->only('username'))
                             ->with('error', 'Username dan password harus diisi!');
            }

            $admin = Admin::where('username', $request->username)->first();

            if ($admin && Hash::check($request->password, $admin->password)) {
                Auth::guard('admin')->login($admin);
                return redirect()->route('admin.dashboard');
            }

            return back()->withInput($request->only('username'))
                         ->with('error', 'Username atau password salah!');

        } else if ($userType == 'siswa') {
            if (!$request->filled('nis') || !$request->filled('password')) {
                return back()->withInput($request->only('nis'))
                             ->with('error', 'NIS dan password harus diisi!');
            }

            $siswa = Siswa::where('nis', $request->nis)->first();

            if ($siswa && Hash::check($request->password, $siswa->password)) {
                Auth::guard('siswa')->login($siswa);
                return redirect()->route('siswa.dashboard');
            }

            return back()->withInput($request->only('nis'))
                         ->with('error', 'NIS atau password salah!');
        }

        return back()->with('error', 'Tipe login tidak valid!');
    }

    public function logout()
    {
        if (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
        } else if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::logout();
        }
        return redirect('/login');
    }

    public function adminDashboard()
    {
        $totalSiswa = Siswa::count();
        $totalPengaduan = Pengaduan::count();
        $menunggu = Pengaduan::where('status', 'menunggu')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();
        $pengaduans = Pengaduan::with('siswa')->latest()->limit(5)->get();

        return view('dashboard.admin', compact('totalSiswa', 'totalPengaduan', 'menunggu', 'selesai', 'pengaduans'));
    }

    public function siswaDashboard()
    {
        $siswaId = Auth::guard('siswa')->id();

        $pengaduans = Pengaduan::where('siswa_id', $siswaId)->latest()->limit(5)->get();

        $totalPengaduan = Pengaduan::where('siswa_id', $siswaId)->count();
        $menunggu = Pengaduan::where('siswa_id', $siswaId)->where('status', 'menunggu')->count();
        $diproses = Pengaduan::where('siswa_id', $siswaId)->where('status', 'diproses')->count();
        $selesai = Pengaduan::where('siswa_id', $siswaId)->where('status', 'selesai')->count();

        return view('siswa.dashboard', compact('pengaduans', 'totalPengaduan', 'menunggu', 'diproses', 'selesai'));
    }
}