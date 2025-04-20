<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaKpa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pakpa';
    protected $fillable = [
        'nama_lengkap',
        'nip',
        'pangkat_id',
        'jabatan',
        'payes',
        'session_input'
    ];

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'pangkat_id', 'id');
    }
}
