<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('user_id')){
            return $next($request);
        }
        else{
            return redirect()->route('login');
        }
        
    }
}
