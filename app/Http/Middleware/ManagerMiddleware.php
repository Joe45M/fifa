<?php

namespace App\Http\Middleware;

use App\Enum\ContractType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return abort(404);
        }

        if (!auth()->user()->currentContract) {
            return abort(404);
        }

        if (!in_array(auth()->user()->currentContract->type, [ContractType::Manager, ContractType::CoManager])) {
            return abort(404);
        }

        return $next($request);
    }
}
