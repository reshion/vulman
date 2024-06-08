<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BearerFakeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->header('Authorization')) {
            $request->headers->set('Authorization', 'Bearer 4|HJEh2uoqdia9oAtKeHUIXcw08coNcxxqTFBvAmkBa304c6df');
        }
        $response = $next($request);



        return $response;
    }
}
