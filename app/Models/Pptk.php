<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pptk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pptk';
    protected $fillable = [
        'nama_lengkap',
        'nip',
        'pangkat_id',
        'jabatan',
        'subkegiatan_id',
        'session_input'
    ];

    public function pangkat() 
    {
        return $this->belongsTo(Pangkat::class);
    }

    public function subkegiatan() 
    {
        return $this->belongsTo(SubKegiatan::class);
    }
}
