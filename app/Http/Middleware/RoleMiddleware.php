<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Foydalanuvchi yo'q yoki roli ruxsat etilganlar ichida bo'lmasa
        if (!$request->user() || !in_array($request->user()->role, $roles)) {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo\'q!');
        }
        
        return $next($request);
    }
}
