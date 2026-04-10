<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;

/* ===================================================================
   PUBLIC ROUTES
   =================================================================== */

Route::get('/', function () {
    return view('index');
});

Route::get('/ds', function () {
    return view('admin.layout');
});

/* ===================================================================
   AUTHENTICATION ROUTES (Breeze Style)
   =================================================================== */

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

/* ===================================================================
   SISWA ROUTES
   =================================================================== */

Route::middleware(['App\Http\Middleware\SiswaMiddleware'])->group(function () {
    Route::get('/siswa/dashboard', [AuthController::class, 'siswaDashboard'])->name('siswa.dashboard');

    /* PENGADUAN */
    Route::get('/siswa/pengaduan', [PengaduanController::class, 'siswaForm'])->name('siswa.pengaduan');
    Route::post('/siswa/pengaduan', [PengaduanController::class, 'siswaSimpan'])->name('siswa.pengaduan.store');

    /* RIWAYAT */
    Route::get('/siswa/riwayat', [PengaduanController::class, 'siswaRiwayat'])->name('siswa.riwayat');
});

/* ===================================================================
   ADMIN ROUTES
   =================================================================== */

Route::prefix('admin')->group(function () {
    Route::resource('siswa', SiswaController::class);
    Route::get('siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
});

Route::middleware(['App\Http\Middleware\AdminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/pengaduan', [PengaduanController::class, 'index'])->name('admin.pengaduan');
    Route::post('/admin/pengaduan/{id}/tanggapan', [PengaduanController::class, 'simpanTanggapan'])->name('admin.pengaduan.tanggapan');
    Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('admin.siswa');
    Route::resource('admin/kategori', KategoriController::class, ['names' => 'admin.kategori']);
});

/* ===================================================================
   TESTING ROUTES (Optional - Remove in Production)
   =================================================================== */

Route::get('/admin/dashboard-test', [AuthController::class, 'adminDashboard'])->name('admin.dashboard.test');

Route::get('/test-feedback', function () {
    $pengaduans = \App\Models\Pengaduan::with(['siswa', 'tanggapans'])->get();

    echo "<h2>Pengaduan dan Feedback</h2>";
    echo "<p>Total Pengaduan: " . count($pengaduans) . "</p>";

    foreach($pengaduans as $p) {
        echo "<hr>";
        echo "<b>ID:</b> " . $p->id . " | <b>Siswa:</b> " . $p->siswa->nama . "<br>";
        echo "<b>Judul:</b> " . $p->judul . "<br>";
        echo "<b>Status:</b> " . $p->status . "<br>";
        echo "<b>Tanggapan:</b> " . count($p->tanggapans) . "<br>";

        if ($p->tanggapans->count() > 0) {
            echo "<ul>";
            foreach($p->tanggapans as $t) {
                echo "<li>" . $t->isi . " (" . $t->created_at->format('d/m/Y H:i') . ")</li>";
            }
            echo "</ul>";
        }
    }
});

Route::get('/test-login-admin', function () {
    $admin = \App\Models\Admin::where('username', 'admin')->first();
    if ($admin) {
        echo "Admin ditemukan: " . $admin->username . "<br>";
        echo "Email: " . $admin->email . "<br>";
        echo "Password hash ada: " . (!empty($admin->password) ? 'YES' : 'NO') . "<br>";

        $testPassword = 'admin123';
        $passwordMatch = \Illuminate\Support\Facades\Hash::check($testPassword, $admin->password);
        echo "Password 'admin123' match: " . ($passwordMatch ? 'YES' : 'NO') . "<br>";

        if ($passwordMatch) {
            \Illuminate\Support\Facades\Auth::guard('admin')->login($admin);
            echo "Manual login SUCCESS!<br>";
            echo "Auth check: " . (\Illuminate\Support\Facades\Auth::guard('admin')->check() ? 'YES' : 'NO');
        }
    } else {
        echo "Admin tidak ditemukan<br>";
    }
});

Route::get('/test-auth', function () {
    $siswaId = \Illuminate\Support\Facades\Auth::guard('siswa')->id();
    return response()->json([
        'siswa_authenticated' => \Illuminate\Support\Facades\Auth::guard('siswa')->check(),
        'siswa_id' => $siswaId,
        'admin_authenticated' => \Illuminate\Support\Facades\Auth::guard('admin')->check(),
        'test' => 'OK'
    ]);
});

Route::get('/test-admin', function () {
    return view('dashboard.admin', [
        'totalSiswa' => 10,
        'totalPengaduan' => 5,
        'menunggu' => 2,
        'selesai' => 1,
        'pengaduans' => []
    ]);
});
