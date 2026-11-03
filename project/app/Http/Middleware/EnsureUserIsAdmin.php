<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Allow the request through only when the logged-in user is an admin.
     * Regular users trying to reach admin pages are sent to their own dashboard.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isAdmin()) {
            abort(403, 'You are not authorized to access the admin panel.');
        }

        return $next($request);
    }
}
