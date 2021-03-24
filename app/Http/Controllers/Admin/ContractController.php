<?php

namespace App\Http\Controllers\Admin;

use App\Contract;
use App\Employee;
use App\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{

    public function index($id)
    {
        $employee = Employee::findOrFail($id);
        $contracts = $employee->contracts;
        return view('admin.contract.index', compact('employee', 'contracts'));
    }

    public function create()
    {
        $employees = Employee::all();
        $types = Type::all();
        return view('admin.contract.create', compact('employees', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|min:1|integer',
            'type_id' => 'required|min:1|integer',
            'hired_date' => 'required|date_format:Y-m-d|',
            'departure_date' => 'required|date_format:Y-m-d|',
        ]);

        $file = $request->file('file');
        if ($file->getSize() > 0) {
            $employeeId = $request->input('employee_id');
            $contractType = $request->input('type_id');
            $hiredDate = $request->input('hired_date');
            $departureDate = $request->input('departure_date');
            $employee = Employee::findorFail($employeeId);
            $fileName = uniqid($employee->first_name . '_' . $employee->last_name) . '.' . $file->getClientOriginalExtension();

            $contract = new Contract();
            $contract->employee_id = $employeeId;
            $contract->type_id = $contractType;
            $contract->hired_date = $hiredDate;
            $contract->departure_date = $departureDate;
            $contract->file_name = $fileName;
            $file->move('public', $fileName);
            $contract->save();

        }

        return redirect()->route('contracts.index', $employeeId)->with('created', true);
    }

    public function editInfo($id)
    {
        $contract = Contract::findOrFail($id);
        $employee = $contract->employee;
        $types = Type::all();
        return view('admin.contract.edit', compact('contract', 'employee', 'types'));

    }

    public function updateInfo(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);
        $employee = $contract->employee;


        $request->validate([

            'type_id' => 'required|min:1|integer',
            'hired_date' => 'required|date_format:Y-m-d|',
            'departure_date' => 'required|date_format:Y-m-d|',
        ]);
        $file = $request->file('file');
        $typeId = $request->input('type_id');
        $hiredDate = $request->input('hired_date');
        $departureDate = $request->input('departure_date');
//        $fileName = uniqid($employee->first_name . '_' . $employee->last_name) . '.' . $file->getClientOriginalExtension();


        $contract->type_id = $typeId;
        $contract->hired_date = $hiredDate;
        $contract->departure_date = $departureDate;
//        $contract->file_name = $fileName;
//        $file->move('public', $fileName);
        $contract->save();

        return redirect()->route('contracts.index', $employee->id)->with('contractUpdated', true);

    }

    public function download($id)
    {
        $dl = Contract::findorFail($id);
        $path_to_file = public_path('/public/' . $dl->file_name);
//        return Storage::response($path_to_file);
        return response()->download($path_to_file, 'example.pdf', [], 'inline');

    }

    public function view($id)
    {
        $dl = Contract::findorFail($id);
        $pathToFile = public_path('/public/' . $dl->file_name);
        return response()->file($pathToFile);
    }

    public function delete($id)
    {
        $contract = Contract::findOrFail($id);
        $employee = $contract->employee;
        $contract->delete();
        return redirect()->route('contracts.index', $employee->id);
    }


}
