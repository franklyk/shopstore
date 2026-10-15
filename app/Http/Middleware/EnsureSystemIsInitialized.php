<?php

namespace App\Http\Middleware;

use App\Models\SystemInstallation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSystemIsInitialized
{
    public function handle(Request $request, Closure $next): Response
    {
        $installation = SystemInstallation::query()->first();

        if (!$installation) {
            abort(503, 'O registro de instalação do sistema não foi encontrado.');
        }

        if (
            $installation->status === 'pending'
            && !$request->routeIs('bootstrap.*')
        ) {
            return redirect()->route('bootstrap.create');
        }

        if (
            $installation->status === 'initialized'
            && $request->routeIs('bootstrap.*')
        ) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
