<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Drop foreign keys and columns that won't be used
            if (Schema::hasColumn('pengaduans', 'siswa')) {
                $table->dropForeign(['siswa']);
                $table->dropColumn('siswa');
            }
            if (Schema::hasColumn('pengaduans', 'kategori_id')) {
                $table->dropForeign(['kategori_id']);
                $table->dropColumn('kategori_id');
            }
            if (Schema::hasColumn('pengaduans', 'isi')) {
                $table->dropColumn('isi');
            }
        });

        Schema::table('pengaduans', function (Blueprint $table) {
            // Add new columns
            if (!Schema::hasColumn('pengaduans', 'siswa_id')) {
                $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            }
            if (!Schema::hasColumn('pengaduans', 'judul')) {
                $table->string('judul');
            }
            if (!Schema::hasColumn('pengaduans', 'deskripsi')) {
                $table->text('deskripsi');
            }
            if (!Schema::hasColumn('pengaduans', 'kategori')) {
                $table->string('kategori');
            }
            if (!Schema::hasColumn('pengaduans', 'prioritas')) {
                $table->enum('prioritas', ['Rendah', 'Sedang', 'Tinggi'])->default('Sedang');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            if (Schema::hasColumn('pengaduans', 'siswa_id')) {
                $table->dropForeign(['siswa_id']);
                $table->dropColumn('siswa_id');
            }
            if (Schema::hasColumn('pengaduans', 'judul')) {
                $table->dropColumn('judul');
            }
            if (Schema::hasColumn('pengaduans', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
            if (Schema::hasColumn('pengaduans', 'kategori')) {
                $table->dropColumn('kategori');
            }
            if (Schema::hasColumn('pengaduans', 'prioritas')) {
                $table->dropColumn('prioritas');
            }
        });
    }
};
