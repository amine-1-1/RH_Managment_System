<?php

namespace App\Http\Controllers\Employee;

use App\Contract;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index($id){
        $employee = Employee::findOrFail($id);
        $contracts = $employee->contracts;
        return view('employee.contract.contract', compact('employee', 'contracts'));

    }
    public function download($id){
        $dl =Contract ::findorFail($id);
        $path_to_file= public_path('/public/'.$dl->file_name);

        return response()->download($path_to_file, 'example.pdf', [], 'inline');

    }
    public function view($id){
        $dl =Contract ::findorFail($id);
        $pathToFile=public_path('/public/'.$dl->file_name);;
        return response()->file($pathToFile );
    }
}
