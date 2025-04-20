<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Belanja extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'belanja';
    protected $fillable = ['subkegiatan_id', 'kode_belanja', 'rekening_belanja'];

    /**
     * relasi dengan table subkegiatan
     */
    public function subkegiatan()
    {
        return $this->belongsTo(SubKegiatan::class, 'subkegiatan_id', 'id');
    }

    /**
     * relasi dengan pagu
     */
    public function pagu()
    {
        return $this->hasMany(Pagu::class, 'belanja_id', 'id');
    }
}
