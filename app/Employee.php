<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use Notifiable;
    protected $guard = 'employee';

    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function admin()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function contracts()
    {
        return $this->hasmany(Contract::class);
    }

    public function payslips()
    {
        return $this->hasmany(Payslip::class);
    }

    public function vacations()
    {
        return $this->hasmany(Vacation::class);
    }
    public function feedbacks()
    {
        return $this->hasmany(Feedback::class);
    }

}
