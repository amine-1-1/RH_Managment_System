<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public function employee()
    {
        return $this->belongsto(Employee::class);
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
