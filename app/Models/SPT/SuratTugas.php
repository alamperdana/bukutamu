<?php

namespace App\Models\SPT;

use App\Models\Belanja;
use App\Models\Transport;
use App\Models\Nodin\Nodin;
use App\Models\SubKegiatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratTugas extends Model
{
    use HasFactory;

    protected $table = 'surat_tugas';
    
    protected $fillable = [
        'tgl_surat',
        'nomor',
        'maksud',
        'transport_id',
        'tujuan',
        'session_input'
    ];

    public function transport()
    {
        return $this->belongsTo(Transport::class, 'transport_id', 'id');
    }

    public function nodin()
    {
        return $this->belongsTo(Nodin::class, 'nodin_id', 'id');
    }

    public function belanja()
    {
        return $this->belongsTo(Belanja::class, 'belanja_id', 'id');
    }

    public function subkegiatan()
    {
        return $this->belongsTo(SubKegiatan::class, 'subkegiatan_id', 'id');
    }
}
