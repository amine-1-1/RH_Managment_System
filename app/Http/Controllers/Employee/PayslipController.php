<?php

namespace App\Http\Controllers\Employee;


use App\Employee;
use App\Http\Controllers\Controller;
use App\Payslip;
use Illuminate\Http\Request;

class PayslipController extends Controller
{
    public function index($id){
        $employee = Employee::findOrFail($id);
        $payslips = $employee->payslips;
        return view('employee.payslip.payslip', compact('employee', 'payslips'));
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
}
