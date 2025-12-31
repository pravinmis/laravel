<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckedSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check()){

            return back()->with(['message'=>'credential not found']);

        }
        
        // if(auth()->user()->role !== "seller"){
        //     return back()->with(['error'=>'permission not found']);
        // }
        return $next($request);
    }
}
