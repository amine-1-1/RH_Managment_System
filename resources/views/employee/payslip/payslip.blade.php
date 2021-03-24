@extends('layouts.employee')

@section('title')
    <title>Employees</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="position: relative">
                    <div class="card-header">
                        {{ ('Payslips') }}
                        of {{ Auth::guard('employee')->user()->first_name }} {{ Auth::guard('employee')->user()->last_name }}</div>
                    <div class="card-body">
                        <table class="table" action="/employee/{{Auth::guard('employee')->user()->id}}/payslips"
                               method="POST"  >
                            <thead>
                            <tr>
                                <th scope="col">Payslip</th>
                                <th scope="col">Month</th>
                                <th scope="col">Year</th>
                                <th scope="col" style="text-align: center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payslips as $payslip)
                                <tr >
                                    <td>{{$payslip->file_name}}</td>
                                    <td>{{date("F", mktime(0, 0, 0, $payslip->month, 10))}}</td>
                                    <td>{{$payslip->year }}</td>
                                    <td>
                                        <div class="row" style="display: flex; justify-content: center;">
                                            <a target="_bl  ank" href="{{route('payslip.view',$payslip->id )}}"
                                               class="btn btn-warning btn-circle mr-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{route('payslip.download',$payslip->id )}}"
                                               class="btn btn-primary btn-circle mr-1">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


