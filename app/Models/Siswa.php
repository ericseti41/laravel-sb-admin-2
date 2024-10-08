<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'nama',
        'sekolah',
        'file',
        'nis',
        'nisn',
        'tempat_lahir',
        'tgl_lahir',
        'ibu',
    ];
}
