<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefLayanan extends Model
{
    use HasFactory;

    protected $table = 'ref_layanan';
    protected $fillable = [
        'layanan',
    ];
}
