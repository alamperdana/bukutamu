<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiLayanan extends Model
{
    use HasFactory;

    protected $table = 'ref_lokasi_layanan';
    protected $fillable = [
        'lokasi_layanan',
    ];
}
