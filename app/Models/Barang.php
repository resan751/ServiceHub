<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang',
        'harga_barang',
        'stok',
    ];
}
