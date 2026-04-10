<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            'Akademik',
            'Fasilitas',
            'Kebersihan',
            'Keamanan',
            'Guru/Pengajar',
            'Kantin',
            'Transportasi',
            'Kesehatan',
            'Bullying/Perundungan',
            'Lingkungan',
            'Lainnya'
        ];

        foreach ($kategoris as $nama) {
            Kategori::firstOrCreate(['nama_kategori' => $nama]);
        }
    }
}
