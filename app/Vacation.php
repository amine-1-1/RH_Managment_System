<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    public function employee()
    {
        return $this->belongsto(Employee::class);
    }
}
