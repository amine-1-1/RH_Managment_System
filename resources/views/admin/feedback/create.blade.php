@extends('layouts.admin')
@section('title')
    <title>add contract</title>
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
    <form class="form-horizontal" action="/feedback" method="POST" enctype="multipart/form-data">
        @csrf

        <fieldset>
            <div id="legend">
                <legend class="">Add Feedbacks</legend>
            </div>
            <div class="control-group">
                <!-- Username -->
                <div class="control-group">
                    <label for="employee_id">name</label>
                    <select id="employee_id" name="employee_id" class="form-control">
                        <option value="0">choose employee</option>
                        @foreach($employees as $employee)
                            <option
                                value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                        @endforeach
                    </select>
                </div>




                <div class="controls">

                    <select name="month" class="form-control">
                        <option value="">Select Month</option>

                        @for ($i = 1; $i<=12; $i++)
                            <option value="{{$i}}">{{date("F", mktime(0, 0, 0, $i, 10))}}</option>
                        @endfor

                    </select>
                </div>
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

            <label for="filename" >Choose file</label>
            <input type="file" name="file" />

            <div class="control-group">
                <!-- Button -->
                <div class="controls" >
                    <button type="submit" class="btn btn-success" >Register</button>
                </div>
            </div>
        </fieldset>
    </form>

@endsection



















