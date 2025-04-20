<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pejabat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pejabat';
    protected $fillable = [
        'nama_lengkap',
        'nip',
        'pangkat_id',
        'jabatan',
        'session_input'
    ];

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'pangkat_id', 'id');
    }
}
