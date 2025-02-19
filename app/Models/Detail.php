<?php

namespace App\Models;
Use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    protected $primaryKey = 'id_detail';
    protected $table = 'details';

    use HasFactory;


    protected $fillable = ['id_service', 'id_barang', 'id_jasa', 'jumlah', 'harga_satuan', 'total_harga'];

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service', 'id_service');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'id_jasa', 'id_jasa');
    }
}
