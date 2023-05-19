<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyISAE
{

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->isISAE) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'You do not have access to this page.');
    }
}
