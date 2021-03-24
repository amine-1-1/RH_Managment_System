<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Role;
use App\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(5);

        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|regex:/^[a-zA-Z]+$/u|max:20',
            'last_name' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
            'email' => 'required|email|max:255|unique:employees',
            'phone_number' => 'required|digits:8',
            'birth_date' => 'required|date_format:Y-m-d|',
        ]);

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $email = $request->input('email');
        $birthDate = $request->input('birth_date');
        $phoneNumber = $request->input('phone_number');
        $password = Str::random(10);

        $employee = new Employee();
        $employee->first_name = $firstName;
        $employee->last_name = $lastName;
        $employee->email = $email;
        $employee->password = Hash::make($password);
        $employee->phone_number = $phoneNumber;
        $employee->birth_date = $birthDate;
        $employee->created_by = Auth::user()->id;
        $employee->active = 0;
        $employee->save();

        $data = [
            'subject' => "Creation de compte",
            'address_from' => (Auth::user()->email),
            'name_from' => (Auth::user()->last_name) . '' . (Auth::user()->first_name),
            'address_to' => $employee->email,
            'name_to' => $employee->first_name . ' ' . $employee->last_name,
            'password_to' => ($password),
        ];
        $mail = new WelcomeMail($data);
        Mail::send($mail);

        return redirect()->route('admin.employee.index')->with(['created'=>true,'active'=>$employee->active,'firstname'=>$employee->first_name,'lastname'=>$employee->last_name]);

    }

    public function editInfo($id)
    {
        $employee = Employee::findOrFail($id);

        return view('admin.employees.edit', compact('employee'));
    }

    public function updateInfo(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'first_name' => 'string|required|max:20',
            'last_name' => 'string|required|max:20',
            'phone_number' => 'required|digits:8',
        ]);

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $phoneNumber = $request->input('phone_number');
        $employee->first_name = $firstName;
        $employee->last_name = $lastName;
        $employee->phone_number = $phoneNumber;
        $employee->save();

        return redirect()->route('admin.employee.index')->with(['profileUpdated'=>true,'active'=>$employee->active,'firstname'=>$employee->first_name,'lastname'=>$employee->last_name]);
    }

    public function editPassword($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employees.password', compact('employee'));
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

        return redirect()->route('admin.employee.index')->with(['passwordUpdated'=>true,'active'=>$employee->active,'firstname'=>$employee->first_name,'lastname'=>$employee->last_name]);
    }
    public function editBonus($id){
        $employee = Employee::findOrFail($id);
        return view('admin.employees.bonus', compact('employee'));

    }
    public function updateBonus(Request $request,$id){
        $employee = Employee::findOrFail($id);

        $request->validate([
            'bonus' => 'required|min:1',
        ]);

        $bonus = $request->input('bonus');
        $employee->bonus = $bonus;
        $employee->save();


        return redirect()->route('admin.employee.index')->with(['bonusUpdated'=>true,'active'=>$employee->active,'firstname'=>$employee->first_name,'lastname'=>$employee->last_name]);

    }

    public function activateOrDeactivate($id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee->active) {
            $employee->active = 0;
        } else {
            $employee->active = 1;
        }
        $employee->save();
        return redirect()->route('admin.employee.index')->with(['activated'=>true,'active'=>$employee->active,'firstname'=>$employee->first_name,'lastname'=>$employee->last_name]);
    }
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $user = Employee::where('email', '=', $email)->first();
        if ($user) {
            return response()->json(['exist' => true, 'email' => $email]);
        } else {
            return response()->json(['exist' => false, 'email' => $email]);
        }
    }

    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('admin.employee.index');
    }
}
