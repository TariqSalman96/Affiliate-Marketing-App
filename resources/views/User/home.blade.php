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

                    <h3>User information</h3>
                    <ul class="list-group mt-3">
                        <li class="list-group-item"><b>Username:</b> {{ Auth::user()->name }}</li>
                        <li class="list-group-item"><b>Email:</b> {{ Auth::user()->email }}</li>
                        <li class="list-group-item"><b>Referral link:</b> {{ Auth::user()->referral_link }}</li>
                        <li class="list-group-item"><b>Referrer:</b> {{ Auth::user()->referrer->name ?? 'Not Specified' }}</li>
                        <li class="list-group-item"><b>A number of registered users through the user referral link:</b> {{ count(Auth::user()->referrals)  ?? '0' }}</li>
                        <li class="list-group-item"><b>A number of visitors that view the user registration page:</b> {{ count(Auth::user()->visitors)  ?? '0' }}</li>
                        <li class="list-group-item"><b>Image:</b> <img src="{{ asset('upload/'.Auth::user()->image) }}" class="img-thumbnail"></li>
                    </ul>

                </div>

                <hr>

                {{--User list that registered through the user referral link.--}}
                <div class="card-body">
                    <h3>Users list that registered through the user referral link.</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Registered Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($referrer_users as $key => $val)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $val->name }}</td>
                                    <td>{{ $val->email }}</td>
                                    <td>{{ date('m/d/Y h:i A', strtotime($val->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr>

                {{--A daily chart that contains the number of registered users (display last 14 days).--}}
                <div class="card-body">
                    {{--Bar chart using Chart JS--}}
                    <canvas id="myChart" width="400" height="400"></canvas>
                    <script>
                        $(document).ready(function (){
                            var period_data = "{{ $period_data }}";
                            period_data = period_data.replace(/&quot;/g, '"');
                            period_data = JSON.parse(period_data);
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: period_data,
                                    datasets: [{
                                        label: 'A daily chart that contains the number of registered users (display last 14 days).',
                                        data: {{ $number_data }},
                                        backgroundColor: [
                                            'rgba(54, 162, 235, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(54, 162, 235, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        })
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
