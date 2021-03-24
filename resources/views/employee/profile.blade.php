@extends('layouts.employee')

@section('title')
    <title>profile</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('employee page test') }} </div>

                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="firstname" data-firstname-id="{{$firstName=session()->get('firstname')}}" ></div>
    <div id="lastname" data-lastname-id="{{$lastName=session()->get('lastname')}}" ></div>
    <div id="password" data-password-id="{{$passwordUpdated=( session()->get('passwordUpdated') == true)}}" ></div>
    <div id="profile" data-profile-id="{{$profileUpdated=session()->get('profileUpdated') == true}}" ></div>


@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('/js/employee/employee/home.js') }}"></script>
@endsection


