<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //User list that registered through the user referral link.
        $referrer_users = User::where('referrer_id', Auth::user()->id)->get();

        //A daily chart that contains the number of registered users (display last 14 days).
        $daily_chart = User::selectRaw('DATE(created_at) as date, COUNT(*) as number')
            ->orderBy('created_at')
            ->groupBy('date')
            ->where('created_at', '>=', Carbon::now()->subDays(14)->toDateTimeString())
            ->where('referrer_id', Auth::user()->id)
            ->pluck('number', 'date')
            ->toarray();

        //To get date period between current and last 14 days
        $date_before_14_days = date('Y-m-d', strtotime(Carbon::now()->subDays(14)));
        $current_date = date('Y-m-d');
        $period = CarbonPeriod::create($date_before_14_days, $current_date);

        //To check if the date has referrer users for all dates between 14 days
        $number_arr = array();
        $period_arr = array();
        foreach ($period as $date) {
            $this_date = $date->format('Y-m-d');
            $period_arr[] = $date->format('Y-m-d');

            if( !empty($daily_chart[$this_date]) ){
                $number_arr[] = $daily_chart[$this_date];
            } else {
                $number_arr[] = 0;
            }
        }

        //Preparing the data for a chart
        //Change array to string separated by comma
        $number_data = json_encode($number_arr);
        $period_data = json_encode($period_arr);

        return view('User.home', compact('referrer_users', 'number_data', 'period_data'));
    }
}
