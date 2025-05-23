<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProfileComplete
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

    if (!$user->username && !$request->is('register/profile')) {
        return redirect('/register/profile');
    }

    return $next($request);
    }
}