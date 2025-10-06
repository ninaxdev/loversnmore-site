<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Skip basic auth if disabled via environment variable
        if (env('BASIC_AUTH_ENABLED', false) === false) {
            return $next($request);
        }

        $username = env('BASIC_AUTH_USERNAME', 'betatester');
        $password = env('BASIC_AUTH_PASSWORD', 'NinaDating2025!');

        // Check if basic auth credentials are provided
        if ($request->getUser() !== $username || $request->getPassword() !== $password) {
            return response('Unauthorized', 401, [
                'WWW-Authenticate' => 'Basic realm="Nina Dating Beta Access"'
            ]);
        }

        return $next($request);
    }
}
