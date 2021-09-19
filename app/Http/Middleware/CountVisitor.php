<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CountVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();//get ip address

        //Return referrer id from referrer token
        $referrer = User::where('referrer_token', $request->ref)->first();
        $referrer_id = $referrer ? $referrer->id : null;

        //Check IP address is visited this site before
        if (Visitor::where('ip', $ip)->where('referrer_id', $referrer_id)->count() < 1
            && $referrer
            && strtoupper($request->method())== 'GET')
        {
            //To store visitors
            Visitor::create([
                'ip' => $ip, //IP Address
                'agent' => $request->userAgent(),//User Agent
                'url' => $request->url(), //URL
                'referrer_id' => $referrer_id, //Referrer ID
            ]);
        }
        return $next($request);
    }
}
