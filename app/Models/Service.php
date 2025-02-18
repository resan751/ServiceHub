<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Service extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_service';

    protected $fillable = [
        'id_user',
        'tanggal',
        'total_harga',
        'keluhan',
        'dibayar',
        'kembalian',
    ];

    public function details()
    {
        return $this->hasMany(Detail::class, 'id_service');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'id_user', 'id_user');
    }
}
