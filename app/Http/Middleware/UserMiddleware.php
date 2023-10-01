<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle(Request $request, Closure $next): Response
{
    if (Auth::check()) {
        if (Auth::user()->role == '1') {
            return $next($request);
        } else {
            return response()->json(['message' => 'Access denied, you are not an Admin']);
        }
    } else {
        return response()->json(['message' => 'Login to access']);
    }
}

}
