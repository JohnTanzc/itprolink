<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        // Store the URL if it's a page belonging to the authenticated user's role
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the current page is a valid page for this user's role
            $validRolePages = [
                'tutee' => 'tutee',  // Any page that starts with 'tutee'
                'tutor' => 'tutor',   // Any page that starts with 'tutor'
                'admin' => 'admin',   // Any page that starts with 'admin'
            ];

            // Loop through the roles to check if the current URL is a valid page for the user's role
            foreach ($validRolePages as $role => $prefix) {
                if ($user->role == $role && strpos($request->route()->getName(), $prefix) === 0) {
                    // Store the URL if it's a valid page for the user's role
                    session(['intended_url' => $request->fullUrl()]);
                    break;
                }
            }
        }

        return $next($request);
    }
}
