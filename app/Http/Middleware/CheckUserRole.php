<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles  The roles allowed to access the route
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Ensure the user is authenticated
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            if ($user) {  // Ensure user is not null
                // Check if the user has one of the allowed roles
                if (in_array($user->role, $roles)) {

                    if ($request->route()->getName() == 'pub.profile' && in_array($user->role, ['tutee', 'admin','tutor'])) {
                        return $next($request);
                    }

                    // Store the previous valid page for the user to be able to go back
                    $this->storeValidPage($request, $user);
                    return $next($request);

                }
            }
        }

        // If not authenticated, redirect to login or homepage
        return redirect('/');
    }

    /**
     * Store the current valid page in the session, based on the user's role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function storeValidPage(Request $request, $user)
    {
        // Define which pages are valid for each user role
        $validRolePages = [
            'tutee' => 'tutee',   // Any page that starts with 'tutee'
            'tutor' => 'tutor',    // Any page that starts with 'tutor'
            'admin' => 'admin',    // Any page that starts with 'admin'
        ];

        // Check if the current page is a valid page for the user's role
        foreach ($validRolePages as $role => $prefix) {
            if ($user->role == $role && strpos($request->route()->getName(), $prefix) === 0) {
                // Store the valid URL in session
                session(['previous_url' => $request->fullUrl()]);
                break;
            }
        }
    }
}
