<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role !== 'admin' && !Auth::user()->is_validated) {
            if ($request->routeIs('waiting.validation')) {
                return $next($request);
            }
            return redirect()->route('waiting.validation');
        }

        return $next($request);
    }
}
