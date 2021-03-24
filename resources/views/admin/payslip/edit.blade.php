@extends('layouts.admin')
@section('title')
    <title>edit-profile</title>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Edit  Payslip of {{ $employee->first_name }} {{ $employee->last_name }} of {{date("F", mktime(0, 0, 0, $payslip->month, 10))}}-{{$payslip->year}}</div>
                    <div class="card-body">
                        <form class="form-horizontal" action="/payslip/{{$payslip->id}}/info" method="POST" id="editPayslip">
                            @csrf
                            <fieldset>
                                <div class="control-group">
                                    <select name="month" class="form-control">
                                        <option value="">Select Month</option>

                                        @for ($i = 1; $i<=12; $i++)
                                            <option value="{{$i}}">{{date("F", mktime(0, 0, 0, $i, 10))}}</option>
                                        @endfor

                                    </select>
                                </div>


                                <div class="control-group">
                                    <div class="controls">
                                        <select name="year" class="form-control">
                                            <option value="">Select Year</option>
                                            @for($year =  Carbon\Carbon::now()->year -2; $year <=  Carbon\Carbon::now()->year +2; $year++)
                                                <option value="{{$year}}">{{$year}}</option>
                                            @endfor


                                        </select>
                                    </div>
                                </div>
                                <label for="filename">Choose file</label>
                                <input type="file" name="file"/>


                                <div class="control-group">
                                    <!-- Button -->
                                    <div class="controls">
                                        <button id="submit" class="btn btn-success float-sm-right "
                                                style="padding: 10px 24px ;margin-top: 5px">Save
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('/js/admin/payslip/edit.js') }}"></script>
@endsection


