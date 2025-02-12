<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_kunjungan',
        'nama',
        'npm',
        'fakultas',
        'prodi',
        'nik',
        'pekerjaan',
        'keperluan',
        'no_telp',
        'jenis_pengunjung'
    ];
}