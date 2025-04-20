<?php

namespace App\Models\Nodin;

use App\Models\Pejabat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Nodin extends Model
{
    use HasFactory;

    protected $table = 'nodin';
    protected $fillable = [
        'kepada',
        'melalui',
        'dari',
        'nomor',
        'tgl_nodin',
        'sifat',
        'lampiran',
        'perihal',
        'isi_nodin',
        'pejabat_id',
        'session_input'
    ];

    public function pejabat()
    {
        return $this->belongsTo(Pejabat::class, 'pejabat_id', 'id');
    }
}
