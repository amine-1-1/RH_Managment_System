<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Payslip;

use Illuminate\Http\Request;

class PayslipController extends Controller
{

    public function index($id)
    {


        $employee = Employee::findOrFail($id);
        $payslips = $employee->payslips;
        return view('admin.payslip.index', compact('employee', 'payslips'));

    }
    public function create()
    {
        $employees = Employee::all();

        return view('admin.payslip.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $request->validate([
            'employee_id' => 'required|min:1|integer',
            'file_name' => 'string',
            'month' => 'required|string|',
            'year' => 'required|integer',
        ]);
        if ($file->getSize() > 0) {
            $employeeId = $request->input('employee_id');
            $startDate = $request->input('month');
            $endDate = $request->input('year');
            $employee = Employee::findorFail($employeeId);
            $fileName = ($employee->first_name . '_' . $employee->last_name . '.'.$startDate.'.'.$endDate.'.' . $file->getClientOriginalExtension());

            $payslip = new Payslip();
            $payslip->employee_id = $employeeId;
            $payslip->month = $startDate;
            $payslip->year = $endDate;
            $payslip->file_name = $fileName;
            $file->move('public', $fileName);
            $payslip->save();

        }
        return redirect()->route('payslips.index', $employeeId)->with('created',true);

    }

    public function editInfo($id)
    {
        $payslip = Payslip::findOrFail($id);
        $employee = $payslip->employee;

        return view('admin.payslip.edit', compact('payslip', 'employee'));

    }

    public function updateInfo(Request $request, $id)
    {
        $payslip = Payslip::findOrFail($id);
        $employee = $payslip->employee;
//        $file = $request->file('file');
        $request->validate([
            'file_name' => 'string',
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);
        $fileName=$request->input('file_name');
        $startDate = $request->input('month');
        $endDate = $request->input('year');
//        $fileName = ($employee->first_name . '_' . $employee->last_name . '.'.$startDate.'.'.$endDate.'.' . $file->getClientOriginalExtension());



//        $payslip->file_name =$fileName;
        $payslip->month = $startDate;
        $payslip->year = $endDate;
//        $payslip->file_name = $fileName;
//        $file->move('public', $fileName);

        $payslip->save();

        return redirect()->route('payslips.index', $employee->id)->with('payslipUpdated',true);

    }
    public function download($id){
        $dl =Payslip ::findorFail($id);
        $path_to_file= public_path('/public/'.$dl->file_name);

        return response()->download($path_to_file, 'example.pdf', [], 'inline');

    }
    public function view($id){
        $dl =Payslip ::findorFail($id);
        $pathToFile=public_path('/public/'.$dl->file_name);;
        return response()->file($pathToFile );
    }


    public function delete($id)
    {
        $payslip = Payslip::findOrFail($id);

        $employee = $payslip->employee;
        $payslip->delete();
        return redirect()->route('payslips.index', $employee->id);

    }
}
