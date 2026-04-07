<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'nama' => 'Budi Santoso',
            'nis' => '2024001',
            'kelas' => '10 A',
            'password' => Hash::make('siswa123'),
        ]);

        Siswa::create([
            'nama' => 'Siti Rahayu',
            'nis' => '2024002',
            'kelas' => '10 B',
            'password' => Hash::make('siswa123'),
        ]);

        Siswa::create([
            'nama' => 'Ahmad Wijaya',
            'nis' => '2024003',
            'kelas' => '10 A',
            'password' => Hash::make('siswa123'),
        ]);
    }
}
