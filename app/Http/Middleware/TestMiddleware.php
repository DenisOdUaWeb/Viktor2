<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(now()->format('s') % 2){
            return $next($request);
        }

        return response('Hi it`s me,(now()->format(\'s\') % 2) NOT EQUAL, SO  it`s hitting test middleware which binded through the route, so its just response() here');
        //return $next($request);
    }
}
