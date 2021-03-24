@extends('layouts.admin')

@section('title')
    <title>Employees</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">{{ __('Payslips') }}
                        of {{ $employee->first_name }} {{ $employee->last_name }}</div>


                    <div class="card-body">
                        <table class="table" action="/employee/{{$employee->id}}/payslips" method="POST">
                            <thead>
                            <tr>
                                <th scope="col">payslip name</th>
                                <th scope="col">month</th>
                                <th scope="col">year</th>
                                <th scope="col" style="text-align: center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payslips as $payslip)
                                <tr>
                                    <td>{{$payslip->file_name}}</td>
                                    <td>{{date("F", mktime(0, 0, 0, $payslip->month, 10))}}</td>
                                    <td>{{$payslip->year }}</td>
                                    <td >
                                        <div class="row" style="display: flex; justify-content: center;">
                                            <a target="_blank" href="{{route('payslip.view',$payslip->id )}}"
                                               class="btn btn-warning btn-circle mr-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{route('payslip.edit.info',$payslip->id )}}"
                                               class="btn btn-info btn-circle mr-1">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <a href="{{route('payslip.download',$payslip->id )}}"
                                               class="btn btn-primary btn-circle mr-1">
                                                <i class="fas fa-download"></i>
                                            </a>

                                            @if(Illuminate\Support\Facades\Auth::user()->role->id ==1)

                                                <button
                                                    class="btn btn-danger btn-circle"><i
                                                        class="fas fa-trash  "
                                                        onclick="deletePayslip({{$payslip->id}})"></i>
                                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                                </button>

                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>


                        </table>


                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="payslip" data-payslip-id="{{$passwordUpdated=( session()->get('payslipUpdated') == true)}}" ></div>
    <div id="create" data-create-id="{{$create=(session()->get('created') == true)}}" ></div>

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('/js/admin/payslip/index.js') }}"></script>

@endsection

