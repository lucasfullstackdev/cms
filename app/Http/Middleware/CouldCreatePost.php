<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CouldCreatePost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->isAdmin() === true) {
            return $next($request);
        }

        if (Auth::user()->isWritter() === true) {
            return $next($request);
        }

        return response()->json(['message' => 'Only Admin and Writter can create post'], Response::HTTP_FORBIDDEN);
    }
}
