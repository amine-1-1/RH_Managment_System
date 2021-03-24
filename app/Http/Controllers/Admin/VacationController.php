<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Vacation;
use Carbon\Carbon;

class VacationController extends Controller
{

    public function index()
    {
        $vacations = Vacation::paginate(5);
        return view('admin.vacations.index', compact('vacations'));
    }

    public function accept($id)
    {
        $vacation = Vacation::findOrFail($id);
        if ($vacation->status == 0) {
            $vacation->status = 1;
            $vacation->save();
        }
        return redirect()->route('vacation.index')->with('accepted',true);


    }

    public function refuse($id)
    {
        $vacation = Vacation::findOrFail($id);
        if ($vacation->status == 0) {
            $vacationDays = (Carbon::parse($vacation->start_date)->diffInDays(Carbon::parse($vacation->end_date)));
            $vacation->employee->bonus = $vacation->employee->bonus +  $vacationDays;
            $vacation->status = 2;

            $vacation->save();
            $vacation->employee->save();
        }
        return redirect()->route('vacation.index')->with('refused',true);

    }

}
