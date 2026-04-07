<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pengaduans')) {
            Schema::create('pengaduans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
                $table->string('judul');
                $table->text('deskripsi');
                $table->string('kategori');
                $table->enum('prioritas', ['Rendah', 'Sedang', 'Tinggi'])->default('Sedang');
                $table->enum('status', ['menunggu', 'diproses', 'selesai'])->default('menunggu');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
