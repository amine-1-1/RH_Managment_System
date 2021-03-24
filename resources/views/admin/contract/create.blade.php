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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Create Contracts</div>
                    <div class="card-body">
                        <form class="form-horizontal" action="/contract" method="POST" enctype="multipart/form-data" id="createContract">
                            @csrf

                            <fieldset>

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


                                </div>

                                <div class="control-group">
                                    <label for="type_id">Contract Type</label>
                                    <select id="type_id" name="type_id" class="form-control">
                                        <option value="0">choose contract</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="controls">
                                    <label for="contract_type">hired_date</label>
                                    <input value="{{old('hired_date')}}" type="date" id="hired_date" name="hired_date"
                                           placeholder="" class="form-control input-sm">
                                    @if($errors->has('hired_date'))
                                        <div class="text-danger">{{ $errors->first('hired_date') }}</div>
                                    @endif
                                    <p class="help-block"></p>
                                </div>
                                <div class="controls">
                                    <label for="contract_type">departure_date</label>
                                    <input value="{{old('departure_date')}}" type="date" id="departure_date"
                                           name="departure_date" placeholder="" class="form-control input-sm">
                                    @if($errors->has('departure_date'))
                                        <div class="text-danger">{{ $errors->first('departure_date') }}</div>
                                    @endif
                                    <p class="help-block"></p>
                                </div>

                                <label for="filename">Choose file</label>
                                <input id="file" type="file" name="file"/>

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
    <script type="text/javascript" src="{{ asset('/js/admin/contract/create.js') }}"></script>
@endsection

















