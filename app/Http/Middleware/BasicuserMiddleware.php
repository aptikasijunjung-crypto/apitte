<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BasicuserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $credentials['email'] = $request->getUser();
        $credentials['password'] = $request->getPassword();
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'response_code' => 401,
                'status'        => 'Unauthorized',
            ]);
        }

        return $next($request);
    }
}
