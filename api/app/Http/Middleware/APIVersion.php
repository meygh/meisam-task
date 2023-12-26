<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class APIVersion
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $version
     *
     * @return Response
     */
    public function handle(Request $request, Closure $next, $version): Response
    {
        config([
            'app.api.version' => $version
        ]);

        return $next($request);
    }
}
