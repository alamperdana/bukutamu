<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'ref_status';
    protected $fillable = [
        'status'
    ];
}
