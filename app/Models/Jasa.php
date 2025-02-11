<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    protected $primaryKey = 'id_jasa';

    protected $fillable = [
        'nama_jasa',
        'harga_jasa',
    ];
}
