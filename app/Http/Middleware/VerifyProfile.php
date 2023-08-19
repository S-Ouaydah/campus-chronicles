<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyProfile
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if user is the same as requested user -> redirect to myprofile
        if (auth()->check() && auth()->user()->id == $request->route('id')) {
            return redirect()->route('profile');
        }
        return $next($request);
    }
}
