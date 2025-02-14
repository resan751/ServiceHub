<?php

namespace App\Models;
Use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $primaryKey = 'id_service';

    protected $fillable = [
        'id_user',
        'tanggal',
        'total_harga'
    ];

    public function details()
    {
        return $this->hasMany(Detail::class, 'id_service');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
