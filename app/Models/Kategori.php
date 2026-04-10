<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori'
    ];

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'kategori', 'nama_kategori');
    }
}
