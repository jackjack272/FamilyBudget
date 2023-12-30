<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\User;

//https://devdojo.com/bobbyiliev/how-to-get-the-current-date-and-time-in-laravel
class IsBannedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
    // if the user is_timed out dont give then access to Create Update Delete
        $timeOut_day=Db::table('users')
            ->where('id',Auth::id())
            ->select('time_out_expire')
            ->get(); // when dose it expire? 9th this month

        $timeOut_day=$timeOut_day[0]->time_out_expire;// 9th this month

        $current_time=Carbon::now()->toArray();
        $day=$current_time['day']; // get current day 
        

    // reinstate user
        if($timeOut_day< $day ) { // bans are 3 days // reinstate user 
            $user=user::findOrFail(Auth::id());
            $user->is_timed_out=false;
            $user->save(); 
        }

        $time_out=Db::table('users')
            ->where('id',Auth::id())
            ->select('is_timed_out')
            ->get(); // true/ false
        $time_out= $time_out[0]->is_timed_out;
        
        if($time_out>0){  // true -send back 
            return back();

        }else{
            return $next($request);
        }

    }
}
