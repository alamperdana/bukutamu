<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PPKom extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ppk';
    protected $fillable = [
        'nama_lengkap',
        'nip',
        'pangkat_id',
        'jabatan',
        'session_input'
    ];

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class);
    }   
}
