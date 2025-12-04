<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // If not logged in, redirect to login page
        if (! $user) {
            return redirect()->route('login');
        }

        // If logged in but not admin, forbid access
        if (! ($user->is_admin ?? false)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
