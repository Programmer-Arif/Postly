<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('user_id')){
            return redirect()->route('allposts');   
        }
        else{
            return $next($request);
        }
    }
}
