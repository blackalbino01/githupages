<?php

namespace App\Http\Middleware;

use Closure;
use App\Support\GoogleAuthenticator;
use Illuminate\Http\Request;

class verify2fa
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
        $authenticator = app(GoogleAuthenticator::class)->boot($request);

        if ($authenticator->isAuthenticated()) {
            return $next($request);
        }

        return $authenticator->makeRequestOneTimePasswordResponse();;
    }
}
