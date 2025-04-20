<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satker extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'satker';
    protected $fillable = ['kode_satker', 'name'];

    /**
     * Relasi dengan table users
     */
    public function users()
    {
        return $this->hasMany(User::class, 'kode_satker', 'kode_satker');
    }
}
