<?php

namespace App\Models\Biaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostHarian extends Model
{
    use HasFactory;

    protected $table = 'ref_cost_harian';
    protected $fillable = [
        'walkot',
        'sekda',
        'eselon_2',
        'eselon_3',
        'eselon_4',
        'gol_4',
        'gol_3',
        'gol_2',
        'gol_1',
        'tkk',
    ];
}
