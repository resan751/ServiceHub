<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Service extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_service';
    protected $table = 'services';

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
        return $this->hasMany(Detail::class, 'id_service', 'id_service');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
