@extends('layouts.admin')

@section('title')
    <title>Employees</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('feedbacks') }} of {{ $employee->first_name }}
                        _{{ $employee->last_name }}</div>

                    <div class="card-header"></div>

                    <div class="card-body">
                        <table class="table" action="/employee/{{$employee->id}}/feedbacks" method="POST">
                            <thead>
                            <tr>
                                <th scope="col">payslip name</th>
                                <th scope="col">month</th>
                                <th scope="col">year</th>
                                <th scope="col">action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feedbacks as $feedback)
                                <tr>
                                    <td>{{$feedback->file_name}}</td>
                                    <td>{{date("F", mktime(0, 0, 0, $feedback->month, 10))}}</td>
                                    <td>{{$feedback->year }}</td>
                                    <td>
                                        <div class="row">
                                            <a target="_blank" href="{{route('feedback.view',$feedback->id )}}"
                                               class="btn btn-warning btn-circle">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{route('feedback.edit.info',$feedback->id )}}"
                                               class="btn btn-info btn-circle">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <a  href="{{route('feedback.download',$feedback->id )}}"
                                                class="btn btn-primary btn-circle">
                                                <i class="fas fa-download"></i>
                                            </a>

                                            @if(Illuminate\Support\Facades\Auth::user()->role->id ==1)

                                                <form action="{{route('feedback.delete',$feedback->id)}}"
                                                      method="POST"
                                                      class="float-left">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-circle"><i
                                                            class="fas fa-trash"></i>
                                                    </button>
                                                </form>

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
@endsection


