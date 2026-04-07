<?php
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Admin Check ===\n";
echo "Admin count: " . \App\Models\Admin::count() . "\n";
foreach(\App\Models\Admin::all() as $admin) {
    echo "Admin: " . $admin->username . " - Email: " . $admin->email . "\n";
}

echo "\n=== Siswa Check ===\n";
echo "Siswa count: " . \App\Models\Siswa::count() . "\n";
foreach(\App\Models\Siswa::all() as $siswa) {
    echo "Siswa: " . $siswa->nis . " - " . $siswa->nama . "\n";
}
