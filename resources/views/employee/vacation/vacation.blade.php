@extends('layouts.employee')

@section('title')
    <title>Vacations</title>
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ ('vacations') }}
                        of {{ Auth::guard('employee')->user()->first_name }} {{ Auth::guard('employee')->user()->last_name }}</div>
                    <div class="card-body">
                        <table class="table" action="/employee/{{Auth::guard('employee')->user()->id}}/vacations"
                               method="POST">
                            <thead>
                            <div class="float-sm-right " style="margin-bottom: 10px; ">
                                <a
                                    href="{{route('vacations.create')}}"
                                    class="btn btn-success btn-icon-split pull-right ">
                                     <span class="icon text-white-50 pull-right ">
                                         <i class="fas fa-plus pull-right "></i>
                                        </span>
                                    <span class="text">Ask for vacation</span>
                                </a></div>

                                <div class="col-xl-3 col-md-6 mb-4 " style="height: 40px ;position: absolute" >
                                    <div class="card border-left-secondary shadow h-100 " >
                                        <div class="card-body">
                                            <div class=" font-weight-bold text-secondary text-uppercase mb-3" style="font-size: 14px;text-align: center;margin-top: -9px">
                                                Remaining Bonus : {{Auth::guard('employee')->user()->bonus}}</div>
                                            <div class="row no-gutters align-items-center"></div>
                                        </div>
                                    </div>
                                </div>

                                <tr>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Days Number</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            <tr>
                                @foreach($vacations as $vacation)
                                <td>{{$vacation->start_date}}</td>
                                <td>{{$vacation->end_date}}</td>
                                <td>{{$vacation->reason}}</td>
                                <td>@if($vacation->start_date == $vacation->end_date) 1 @else {{ \Carbon\Carbon::parse ($vacation->start_date)->diffInDays(\Carbon\Carbon::parse ($vacation->end_date))}} @endif</td>

                                <td style="font-weight: bold">@if($vacation->status==0)Being processed @elseif($vacation->status==1)
                                        accepted @else Refused @endif </td>

                                <td>

                            </tr>


                            </tbody>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



