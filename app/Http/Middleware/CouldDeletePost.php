<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CouldDeletePost
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

        $post = Post::find($request->route('id'));
        if (Auth::user()->isWritter() === true && Auth::user()->id === $post->created_by) {
            return $next($request);
        }

        return response()->json(['message' => 'You are not authorized to delete this post'], Response::HTTP_FORBIDDEN);
    }
}
