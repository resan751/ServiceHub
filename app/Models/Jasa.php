<?php

namespace App\Models;
Use App\Models\Detail;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    protected $primaryKey = 'id_jasa';

    protected $fillable = [
        'nama_jasa',
        'harga_jasa',
    ];

    public function detail()
    {
        return $this->BelongsTo(Detail::class, 'id_jasa');
    }
}
