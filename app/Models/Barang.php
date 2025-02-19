<?php

namespace App\Models;
use App\Models\Detail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_barang';
    protected $table = 'Barangs';

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
