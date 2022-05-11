<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Services\UserService;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = (new UserService)->getRequest('get', 'user/authenticate');

        if (!$response->ok()) {
            abort(401, 'Unauthorized');
        } elseif (!$response->json()['data']['is_admin']) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
