@extends('layouts.admin')
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
                    <div class="card-header">Edit user {{ $user->first_name }}_{{ $user->last_name }}</div>
                    <div class="card-body">
                        <form class="form-horizontal" action="/user/{{$user->id}}/password" method="POST" id="editPassword">
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

                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <button id="submit" class="btn btn-success float-sm-right "
                                style="padding: 10px 24px ;margin-top: 5px">Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('/js/admin/user/edit-password.js') }}"></script>
@endsection










































{{--@section('script')--}}
{{--    <script type="text/javascript">--}}
{{--        $('form#editPassword').validate({--}}
{{--            errorClass: 'input-error',--}}
{{--            rules: {--}}
{{--                new_password: {--}}
{{--                    required: true,--}}
{{--                    minlength: 8--}}
{{--                },--}}
{{--                new_password_confirmation: {--}}
{{--                    required: true,--}}
{{--                    minlength: 8--}}
{{--                },--}}

{{--                messages: {--}}
{{--                    new_password: "Please specify your password",--}}
{{--                    new_password_confirmation: "Please specify your Last Name",--}}

{{--                },--}}
{{--            }--}}
{{--        });--}}
{{--        $('#submit').click(function () {--}}

{{--            var form = $("form#editPassword")--}}
{{--            if (form.valid()) {--}}
{{--                form.submit();--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}


