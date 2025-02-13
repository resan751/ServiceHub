<?php

namespace App\Models;
Use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{


    public function service()
    {
        return $this->hasMany(Detail::class, 'id_detail');
    }
}
