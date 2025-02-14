<?php

namespace App\Models;
Use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_service',
        'id_barang',
        'id_jasa',
        'jumlah',
        'harga_satuan',
        'total_harga'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'id_jasa');
    }
}
