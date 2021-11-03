<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerAuth
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
        if (session()->has('customer_logged_in') && ( url('/customer/login') == $request->url() || url('customer/register') == $request->url()))
        {
            return back();
        }
        return $next($request);
    }
}
