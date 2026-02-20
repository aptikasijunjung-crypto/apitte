<?php

namespace App\Http\Middleware\API;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    private const USER = 'admin';
    private const PASS = 'admin';
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->getUser() !== self::USER || $request->getPassword() !== self::PASS) {
            return response()->json([
                'response_code' => 401,
                'status'        => 'Unauthorized',
            ]);
        }
        return $next($request);
    }
}
