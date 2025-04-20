<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pegawai';
    protected $fillable = [
        'nama_lengkap',
        'eselon_id',
        'nip',
        'pangkat_id',
        'jabatan',
        'satker_id',
        'session_input'
    ];

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'pangkat_id', 'id');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id', 'id');
    }

    public function eselon()
    {
        return $this->belongsTo(Eselon::class, 'eselon_id', 'id');
    }
}
