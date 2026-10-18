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

        $route = $request->route();

        if (!$route) {
            return $next($request);
        }

        $routeName = $route->getName();

        $isBootstrapRoute = $request->routeIs('bootstrap.*');
        $isVerificationRoute = $request->routeIs('verification.*');
        $isSuperAdminSetupRoute = $request->routeIs(
            'admin.system.super-admin.*'
        );

        if ($installation->status === 'pending') {
            if (!$isBootstrapRoute) {
                return redirect()->route('bootstrap.create');
            }

            return $next($request);
        }

        if ($installation->status === 'owner_verification') {
            if (!$isVerificationRoute && $routeName !== 'logout') {
                abort(403, 'Confirme o e-mail do Owner para continuar.');
            }

            return $next($request);
        }

        if ($installation->status === 'super_admin_setup') {
            if (
                !$isSuperAdminSetupRoute
                && !$isVerificationRoute
                && $routeName !== 'logout'
            ) {
                abort(
                    403,
                    'O cadastro do Super Admin precisa ser concluído.'
                );
            }

            return $next($request);
        }

        if (
            $installation->status === 'initialized'
            && ($isBootstrapRoute || $isSuperAdminSetupRoute)
        ) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
