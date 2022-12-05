<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class SubscriptionMiddleware
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
       $will_expire=Auth::user()->will_expire;
       if ($will_expire < now() && $will_expire != '0000-00-00') {
        return redirect('/user/dashboard');   
       }

       if ($will_expire == null || $will_expire == '') {
          return redirect('/user/dashboard');   
       }
        return $next($request);
    }
}
