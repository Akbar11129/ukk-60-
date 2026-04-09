<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'prioritas',
        'status',
        'siswa_id',
        'foto'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // 1 Pengaduan dimiliki oleh 1 Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // 1 Pengaduan memiliki banyak Tanggapan
    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR (Optional - supaya lebih rapi di view)
    |--------------------------------------------------------------------------
    */

    public function getPrioritasLabelAttribute()
    {
        return ucfirst($this->prioritas);
    }

    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }
}