<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccountStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->active == 0) {
            Auth::logout();

            return redirect()->route('account.blocked');
        }

        return $next($request);
    }
}
