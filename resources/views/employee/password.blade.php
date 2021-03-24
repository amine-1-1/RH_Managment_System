@extends('layouts.employee')
@section('title')
    <title>edit-password</title>
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
                    <div class="card-header">Change Password </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="/employee/{{$employee->id}}/password" method="POST" id="editPassword">
                            @csrf
                            <fieldset>
                                <div class="control-group">
                                    <!-- Username -->

                                    <label class="control-label"  for="password">new_password</label>
                                    <div class="controls">
                                        <input value="" type="password" id="new_password" name="new_password" placeholder="" class="form-control input-sm">
                                        @if($errors->has('password'))
                                            <div class="text-danger">{{ $errors->first(' password') }}</div>
                                        @endif
                                        <p class="help-block"></p>
                                    </div>
                                    <label class="control-label"  for="password">confirm_new_password</label>
                                    <div class="controls">
                                        <input value="" type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="" class="form-control input-sm">
                                        @if($errors->has('password'))
                                            <div class="text-danger">{{ $errors->first('password') }}</div>
                                        @endif
                                        <p class="help-block"></p>
                                    </div>

                                </div>

                                <div class="control-group">
                                    <!-- Button -->
                                    <div class="controls">
                                        <button type="submit" class="btn btn-success float-sm-right "
                                                style="padding: 10px 24px">Save
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
    <script type="text/javascript" src="{{ asset('/js/employee/employee/password.js') }}"></script>
@endsection

