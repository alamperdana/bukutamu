<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubKegiatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subkegiatan';
    protected $fillable = ['instansi_anggaran', 'kode_subkegiatan', 'subkegiatan', 'session_input'];

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'instansi_anggaran', 'kode_satker');
    }
}
