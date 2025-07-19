<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyOrigin
{
    public function handle(Request $request, Closure $next)
    {
        $origin = $request->header('Origin');

        $allowed = [
            'http://aslpera.emock.local',
        ];

        if ($origin && !in_array($origin, $allowed)) {
            abort(403, 'Origin not allowed');
        }

        return $next($request);
    }
}
