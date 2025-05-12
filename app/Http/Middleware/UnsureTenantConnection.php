<?php

namespace App\Http\Middleware;

use App\Actions\TenantConnection;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UnsureTenantConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        app(TenantConnection::class, [
            'user' => $request->user(),
        ])->execute();
        
        return $next($request);
    }
}
