<?php

namespace App\Models\Biaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostRepresentasiDD extends Model
{
    use HasFactory;

    protected $table = 'ref_cost_representasi_dd';
    protected $fillable = [
        'satuan',
        'lev_1',
        'lev_2',
        'lev_3'
    ];
}
