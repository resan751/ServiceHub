<?php

namespace App\Models;
Use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function User()
    {
        return $this->hasMany(Detail::class, 'id_user');
    }

}
