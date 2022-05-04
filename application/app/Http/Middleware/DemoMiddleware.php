<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class DemoMiddleware
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
        if ( !$request->is('lo*') && !$request->isMethod('get') && env('APP_DEMO') ) {
            return back()->with('message', "Demo Version. You can not do it.");
        }
        return $next($request);
    }
}
