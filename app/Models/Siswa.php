<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $fillable = [
        'nama',
        'nis',
        'kelas',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
