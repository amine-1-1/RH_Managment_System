<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function contracts()
    {
        return $this->belongsToMany('App\Contract');
    }
}
