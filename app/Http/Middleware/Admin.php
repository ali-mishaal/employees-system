<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( !Auth::guest() && (Auth::user()->isadmin == 1) ){

           return $next($request); 
        }

        if(!Auth::guest() && Auth::user())
        {
           return redirect( route('home') )->with('msg' , 'you not admin'); 
        }

        
    }
}
