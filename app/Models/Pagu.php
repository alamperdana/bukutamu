<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pagu_belanja';
    protected $fillable = ['belanja_id', 'pagu', 'keterangan', 'session_input'];

    public function belanja()
    {
        return $this->belongsTo(Belanja::class, 'belanja_id');
    }
}
