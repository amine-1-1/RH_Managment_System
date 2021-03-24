<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    public function employee()
    {
        return $this->belongsto(Employee::class);
    }
}
