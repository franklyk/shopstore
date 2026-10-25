<?php

namespace App\Http\Middleware;

use App\Models\SystemInstallation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSystemIsInitialized
{

    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $installation = SystemInstallation::query()->first();

        if (!$installation) {
            abort(503, 'O registro de instalação do sistema não foi encontrado.');
        }

        $route = $request->route();

        $routeName = $route?->getName() ?? '';

        if ($installation->status === 'pending') {
            if (!str_starts_with($routeName, 'bootstrap.')) {
                return redirect()->route('bootstrap.create');
            }

            return $next($request);
        }

        if ($installation->status === 'owner_verification') {
            if (
                str_starts_with($routeName, 'verification.')
                || $routeName === 'logout'
            ) {
                return $next($request);
            }

            abort(403, 'Aguarde a verificação do e-mail do Owner.');
        }

        if ($installation->status === 'super_admin_setup') {
            $allowedRoutes = [
                'admin.system.super-admin.',
                'admin.system.users.permissions.',
                'verification.',
            ];

            foreach ($allowedRoutes as $prefix) {
                if (str_starts_with($routeName, $prefix)) {
                    return $next($request);
                }
            }

            if ($routeName === 'logout') {
                return $next($request);
            }

            abort(403, 'Conclua a configuração inicial do sistema.');
        }

        if ($installation->status === 'initialized') {
            if (
                str_starts_with($routeName, 'bootstrap.')
                || str_starts_with(
                    $routeName,
                    'admin.system.super-admin.'
                )
            ) {
                return redirect()->route('login');
            }

            return $next($request);
        }

        abort(503, 'O estado de instalação do sistema é inválido.');
    }
}
