<?php

namespace App\Models;

use App\Models\Referensi\Status;
use App\Models\Referensi\Layanan;
use App\Models\Referensi\LokasiLayanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'catatan',
        'photo_path',
        'latitude',
        'longitude',
        'ip_address',
        'status_id',
        'keterangan'
    ];

    public function getPhotoUrlAttribute()
    {
        return $this->photo_path ? asset('storage/' . $this->photo_path) : null;
    }

    public function Lokasi() 
    {
        return $this->belongsTo(LokasiLayanan::class);
    }

    public function Layanan() 
    {
        return $this->belongsTo(Layanan::class);
    }

    public function Status() 
    {
        return $this->belongsTo(Status::class);
    }
}
