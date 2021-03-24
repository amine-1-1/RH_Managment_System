@extends('layouts.admin')

@section('title')
    <title>Employees</title>
@endsection
@section('style')
    <style>
        .pagination > li > a,
        .pagination > li > span {
            color: #5a5c69 !Important;
        }

        .pagination > .active > a,
        .pagination > .active > a:focus,
        .pagination > .active > a:hover,
        .pagination > .active > span,
        .pagination > .active > span:focus,
        .pagination > .active > span:hover {
            background-color: #5a5c69 !Important;
            border-color: #5a5c69 !Important;
            color: white !Important;

        }

    </style>

@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Employees') }}</div>

                    <div class="card-body">

                        <table class="table">

                            <div class="float-sm-right " style="margin-bottom: 10px; ">
                                <a href="/employee-create" class="btn btn-success btn-icon-split ">
                                <span class="icon text-white-50 ">
                                <i class="fas fa-plus"></i>
                                 </span>
                                    <span class="text">new employee</span>
                                </a>
                            </div>
                            <thead>


                            <tr>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="text-align: center">Actions</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{$employee->first_name}}</td>
                                    <td>{{$employee->last_name}}</td>
                                    <td>{{$employee->email }}</td>
                                    <td>
                                        @if($employee->active)
                                            <div style="color: green;font-family:arial;font-size: medium">Active</div>
                                        @else
                                            <div style="color: red;font-family:arial;font-size: medium">inactive</div>
                                        @endif
                                    </td>


                                    @if(Illuminate\Support\Facades\Auth::user()->role->id ==1||Illuminate\Support\Facades\Auth::user()->role->id ==2)

                                        <td>

                                            <div class="row" style="display: flex; justify-content: center;">
                                                <a href="{{route('admin.employee.edit.password',$employee->id)}}"
                                                   class="btn btn-warning btn-circle  mr-1 ">
                                                    <i class="fas fa-key"></i>
                                                </a>
                                                <a href="{{route('admin.employee.edit.info',$employee->id)}}"
                                                   class="btn btn-info btn-circle btn mr-1">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <a href="{{route('contracts.index',$employee->id)}}"
                                                   class="btn btn-primary btn-circle btn mr-1">
                                                    <i class="fas fa-file-contract"></i>
                                                </a>
                                                <a href="{{route('payslips.index',$employee->id)}}"
                                                   class="btn btn-secondary btn-circle btn mr-1">
                                                    <i class="fas fa-money-check"></i>
                                                </a>
                                                <form action="{{route('employee.active',$employee->id)}}" method="POST"
                                                      class="float-left" aria-expanded="false">
                                                    {{ method_field('POST') }}
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn @if($employee->active) btn-danger @else btn-success @endif btn-circle btn mr-1">
                                                        @if($employee->active)
                                                            <i class="fas fa-times"></i>
                                                        @else
                                                            <i class="fas fa-check"></i>
                                                        @endif
                                                    </button>
                                                    @endif
                                                </form>

                                                <a href="{{route('employee.edit.bonus',$employee->id)}}"
                                                   class="btn btn-primary btn-circle btn mr-1  ">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                                @if(Illuminate\Support\Facades\Auth::user()->role->id ==1)

                                                    <button class="btn btn-danger btn-circle"><i
                                                            class="fas fa-trash  "
                                                            onclick="deleteEmployee({{$employee->id}})"></i>
                                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                                    </button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach


                            </tbody>

                        </table>
                        <div class="pagination justify-content-center ">
                            {{ $employees->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="password" data-password-id="{{$passwordUpdated=( session()->get('passwordUpdated') == true)}}" ></div>
    <div id="create" data-create-id="{{$create=(session()->get('created') == true)}}" ></div>
    <div id="profile" data-profile-id="{{$profileUpdated=session()->get('profileUpdated') == true}}" ></div>
    <div id="bonus" data-bonus-id="{{$bonusUpdated=session()->get('bonusUpdated') == true}}" ></div>
    <div id="activated" data-activated-id="{{$activated=session()->get('activated') == true}}" ></div>
    <div id="firstname" data-firstname-id="{{$firstName=session()->get('firstname')}}" ></div>
    <div id="lastname" data-lastname-id="{{$lastName=session()->get('lastname')}}" ></div>

@endsection
@section('script')
    <script type="text/javascript"
            src="{{ asset('/js/admin/employee/index.js') }}"></script>
@endsection






