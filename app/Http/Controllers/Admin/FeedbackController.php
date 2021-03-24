<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    public function index($id)
    {
        $employee = Employee::findOrFail($id);
        $feedbacks = $employee->feedbacks;
        return view('admin.feedback.index', compact('employee', 'feedbacks'));

    }

    public function create()
    {
        $employees = Employee::all();


        return view('admin.feedback.create', compact('employees'));
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
            $fileName = ($employee->first_name . '_' . $employee->last_name . '.' . $startDate . '.' . $endDate . '.' . $file->getClientOriginalExtension());

            $feedback = new Feedback();
            $feedback->employee_id = $employeeId;
            $feedback->month = $startDate;
            $feedback->year = $endDate;
            $feedback->file_name = $fileName;
            $file->move('public', $fileName);
            $feedback->save();

        }
        return redirect()->route('feedbacks.index', $employeeId);
    }

    public function editInfo($id)
    {
        $feedback = Feedback::findOrFail($id);
        $employee = $feedback->employee;

        return view('admin.feedback.edit', compact('feedback', 'employee'));

    }
    public function updateInfo(Request $request, $id)
    {
        $payslip = Feedback::findOrFail($id);
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

        return redirect()->route('feedbacks.index', $employee->id);

    }
    public function download($id){
        $dl =Feedback ::findorFail($id);
        $path_to_file= public_path('/public/'.$dl->file_name);

        return response()->download($path_to_file, 'example.pdf', [], 'inline');

    }
    public function view($id){
        $dl =Feedback ::findorFail($id);
        $pathToFile=public_path('/public/'.$dl->file_name);;
        return response()->file($pathToFile );
    }


    public function delete($id)
    {
        $payslip = Feedback::findOrFail($id);

        $employee = $payslip->employee;
        $payslip->delete();
        return redirect()->route('feedbacks.index', $employee->id);

    }


}
