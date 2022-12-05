<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocalizationMiddleware
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
        if (\Session::has('locale')==true) {
            \App::setlocale(\Session::get('locale'));
        }
        else{
            \Session::put('locale', env('DEFAULT_LANG', config('app.locale')));
            \App::setlocale(\Session::get('locale'));
        }
        return $next($request);
    }
}
