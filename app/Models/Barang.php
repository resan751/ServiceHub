<?php

namespace App\Models;
use App\Models\Detail;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang',
        'harga_barang',
        'stok',
    ];

    public function detail()
    {
        return $this->BelongsTo(Detail::class, 'id_barang');
    }
}
