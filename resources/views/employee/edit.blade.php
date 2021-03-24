@extends('layouts.employee')
@section('title')
    <title>edit-profile</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Edit {{ $employee->first_name }} {{ $employee->last_name }}</div>
                     <div class="card-body">
                        <form class="form-horizontal" action="/employee/{{$employee->id}}/info" method="POST" id="editEmployee">
                            @csrf
                            <fieldset>
                                <div class="control-group">
                                    <!-- Username -->
                                    <label class="control-label" for="first_name">First Name</label>
                                    <div class="controls">
                                        <input value="{{ $employee->first_name }}" type="text" id="first_name"
                                               name="first_name" placeholder="" class="form-control input-sm">
                                        @if($errors->has('first_name'))
                                            <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                        @endif
                                        <p class="help-block"></p>
                                    </div>
                                    <label class="control-label" for="last_name">Last Name</label>
                                    <div class="controls">
                                        <input value="{{ $employee->last_name }}" type="text" id="last_name"
                                               name="last_name" placeholder="" class="form-control input-sm">
                                        @if($errors->has('last_name'))
                                            <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                        @endif
                                        <p class="help-block"></p>
                                    </div>
                                    <label class="control-label" for="birth_date">Birth Date</label>
                                    <div class="controls">
                                        <input value="{{ $employee->birth_date}}" type="date" id="birth_date"
                                               name="birth_date" placeholder="" class="form-control input-sm">
                                        <p class="help-block"></p>
                                    </div>
                                    <label class="control-label" for="phone_number">Phone Number</label>
                                    <div class="controls">
                                        <input value="{{ $employee->phone_number}}" type="text" id="phone_number"
                                               name="phone_number" placeholder="" class="form-control input-sm">
                                        <p class="help-block"></p>
                                    </div>

                                </div>

                                <div class="control-group">
                                    <!-- E-mail -->
                                    <label class="control-label" for="email">Email</label>
                                    <div class="controls">
                                        <input value="{{ $employee->email }}" disabled type="text" id="email"
                                               name="email" placeholder="" class="form-control input-sm">
                                        <p class="help-block"></p>
                                    </div>

                                </div>

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
    <script type="text/javascript" src="{{ asset('/js/employee/employee/edit.js') }}"></script>
@endsection

