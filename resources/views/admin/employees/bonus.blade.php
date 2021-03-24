@extends('layouts.admin')

@section('title')
    <title>Employees</title>
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Bonus of {{ $employee->first_name }} {{ $employee->last_name }}</div>
                    <div class="card-body">
                        <form class="form-horizontal" action="/employee/{{$employee->id}}/bonus" method="POST">
                            @csrf

                            <fieldset>
                                <div class="control-group">
                                    <!-- Username -->
                                    <label class="control-label" for="bonus">Bonus</label>
                                    <input type="number" min="0" name="bonus" id="bonus" value="{{$employee->bonus}}"
                                           placeholder="" class="form-control" required/>

                                    <div class="control-group">
                                        <!-- Button -->
                                        <div class="controls">
                                            <button type="submit" class="btn btn-success float-sm-right "
                                                    style="padding: 10px 24px;margin-top: 5px">Save
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


