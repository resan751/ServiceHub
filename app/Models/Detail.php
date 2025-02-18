<?php

namespace App\Models;
Use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    protected $primaryKey = 'id_detail';

    use HasFactory;


    protected $fillable = ['id_service', 'id_barang', 'id_jasa', 'jumlah', 'harga_satuan', 'total_harga'];

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }
}
