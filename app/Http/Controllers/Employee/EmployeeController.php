<?php

namespace App\Http\Controllers\Employee;
use App\Contract;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employee.profile', compact('employees'));
    }
    public function editInfo($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employee.edit', compact('employee'));
    }

    public function updateInfo(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'first_name' => 'string|required|max:20',
            'last_name' => 'string|required|max:20',
            'birth_date'=> 'required|date_format:Y-m-d|',
            'phone_number' =>'required|required|digits:8',

        ]);

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $phoneNumber =$request->input('phone_number');
        $birthDate =$request->input('birth_date');


        $employee->first_name = $firstName;
        $employee->last_name = $lastName;
        $employee->phone_number =$phoneNumber;
        $employee->birth_date = $birthDate;
        $employee->save();
        return redirect()->route('employee.profile.index')->with(['profileUpdated'=>true,'active'=>$employee->active,'firstname'=>$employee->first_name,'lastname'=>$employee->last_name]);
    }
    public function editPassword($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.password', compact('employee'));
    }

    public function updatePassword(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $request->validate([
            'new_password' => 'required|confirmed|min:8',

        ]);

        $password = $request->input('new_password');
        $employee->password = Hash::make($password);
        $employee->save();

        return redirect()->route('employee.profile.index')->with(['passwordUpdated'=>true,'active'=>$employee->active,'firstname'=>$employee->first_name,'lastname'=>$employee->last_name]);
    }




}
