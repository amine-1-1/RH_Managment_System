<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacationController extends Controller
{
    public function index($id)
    {
        $employee = Employee::findOrFail($id);
        $vacations = $employee->vacations;
        return view('employee.vacation.vacation', compact('employee', 'vacations'));

    }

    public function createVacation()
    {

        return view('employee.vacation.vacations-create');

    }

    public function storeVacation(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date_format:Y-m-d|',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'reason' => 'required|string|max:100',

        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $reason = $request->input('reason');

        if (Auth::guard('employee')->user()->bonus >= (Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)))) {
            $vacation = new Vacation();
            $vacation->start_date = $startDate;
            $vacation->end_date = $endDate;
            $vacation->reason = $reason;
            $vacation->employee_id = Auth::guard('employee')->user()->id;
            $employee = Employee::findOrFail(Auth::guard('employee')->user()->id);
            $employee->bonus = $employee->bonus - (Carbon::parse($vacation->start_date)->diffInDays(Carbon::parse($vacation->end_date)));
            if (($vacation->start_date) == ($vacation->end_date)) {
                $employee->bonus = $employee->bonus - 1;
            }

            $vacation->save();
            $employee->save();
            return redirect()->route('employee.vacations', Auth::guard('employee')->user()->id);
        } else {
            return redirect()->route('employee.vacations', Auth::guard('employee')->user()->id);
        }

    }
}
