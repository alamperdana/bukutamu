<?php

namespace App\Models\Biaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostRepresentasi extends Model
{
    use HasFactory;

    protected $table = 'ref_cost_representasi';
    protected $fillable = [
        'walkot',
        'sekda',
        'eselon_2',
    ];
}
