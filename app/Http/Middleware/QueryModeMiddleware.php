<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QueryModeMiddleware
{
public function handle(Request $request, Closure $next): Response
{
    if ($request->query('mode') !== 'debug') {
        return response('Access denied. Add ?mode=debug parameter', 403);
    }
    return $next($request);
}
}
