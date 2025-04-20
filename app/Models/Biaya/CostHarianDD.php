<?php

namespace App\Models\Biaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostHarianDD extends Model
{
    use HasFactory;

    protected $table = 'ref_cost_harian_dd';
    protected $fillable = [
        'tujuan',
        'satuan',
        'lev_1',
        'lev_2',
        'lev_3',
        'lev_4',
        'lev_5',
        'lev_6',
    ];
}
