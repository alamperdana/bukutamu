<?php

namespace App\Models\Biaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostUangHarian extends Model
{
    use HasFactory;
    protected $table = 'ref_uang_harian';
    protected $fillable = [
        'tujuan',
        'satuan',
        'lev_1',
        'lev_2',
    ];
}
