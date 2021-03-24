@extends('layouts.admin')

@section('title')
    <title>Employees</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">{{ __('Contracts') }}
                        of {{ $employee->first_name }} {{ $employee->last_name }}</div>

                    <div class="card-body">
                        <table class="table" action="/employee/{{$employee->id}}/contracts" method="POST">
                            <thead>
                            <tr>
                                <th scope="col">contract type</th>
                                <th scope="col">hired date</th>
                                <th scope="col">end date</th>
                                <th scope="col" style="text-align: center">action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contracts as $contract)
                                <tr>
                                    <td>{{$contract->type->name}}</td>
                                    <td>{{$contract->hired_date}}</td>
                                    <td>{{$contract->departure_date }}</td>

                                    <td>
                                        <div class="row" style="display: flex; justify-content: center;">
                                            <a target="_blank" href="{{route('contract.view',$contract->id )}}"
                                               class="btn btn-warning btn-circle mr-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href=" {{route('contract.edit.info',$contract->id )}}"
                                               class="btn btn-info btn-circle mr-1">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <a href="{{route('contract.download',$contract->id )}}"
                                               class="btn btn-primary btn-circle">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            @if(Illuminate\Support\Facades\Auth::user()->role->id ==1)

                                                <button
                                                    class="btn btn-danger btn-circle"><i
                                                        class="fas fa-trash  "
                                                        onclick="deleteContract({{$contract->id}})"></i>
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
    <div id="contract" data-contract-id="{{$contractUpdated=( session()->get('contractUpdated') == true)}}" ></div>
    <div id="create" data-create-id="{{$create=(session()->get('created') == true)}}" ></div>
@endsection
@section('script')

    <script type="text/javascript" src="{{ asset('/js/admin/contract/index.js') }}"></script>

@endsection
