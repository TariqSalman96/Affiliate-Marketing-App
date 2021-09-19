@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    {{--User information--}}
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h3>Admin information</h3>
                        <ul class="list-group mt-3">
                            <li class="list-group-item"><b>Username:</b> {{ Auth::user()->name }}</li>
                            <li class="list-group-item"><b>Email:</b> {{ Auth::user()->email }}</li>
                        </ul>
                    </div>

                    <hr>

                    {{-- list of registered users with the following columns (Name, Email, registered date, Number of referred users).--}}
                    <div class="card-body">
                        <h3>list of registered users.</h3>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Registered Date</th>
                                <th scope="col">Number of referred users</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $val)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $val->name }}</td>
                                    <td>{{ $val->email }}</td>
                                    <td>{{ date('m/d/Y h:i A', strtotime($val->created_at)) }}</td>
                                    <td>{{ count($val->referrals)  ?? '0' }}</td>
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
