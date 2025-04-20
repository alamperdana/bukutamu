<?php

namespace App\Models\Biaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostTaxi extends Model
{
    use HasFactory;

    protected $table = 'ref_cost_taxi';
    protected $fillable = [
        'harga',
        'satuan',
    ];
}
