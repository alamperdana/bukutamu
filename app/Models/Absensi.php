<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $fillable = [
        'lokasi_layanan_id',
        'asal',
        'jabatan',
        'nama',
        'no_telp',
        'layanan_id',
        'lainnya',
        'photo_path',
        'latitude',
        'longitude',
        'tanggal',
        'jam_pelayanan'
    ];    
}
