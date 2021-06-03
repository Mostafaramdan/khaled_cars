<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BankMiddleware
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
        if (auth('bank')->check())
        {
            return $next($request);
        }
        else {
            return redirect()->route('bank.show_login_form');
        }
    }
}
