<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // before middleware
        Log::info('app.request', ['request' => $request->all(), 'header' => $request->headers->all()]);

        // after middleware
        $response = $next($request);
        Log::info('app.response', [$response]);

        return $response;
    }
}
