<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsEmployee
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        $user = Auth::user();

        if (!$user || !$user->is_employee) {
            return redirect()
                ->route('home')
                ->with(
                    'error',
                    'Você não tem permissão para acessar o administrativo.'
                );
        }

        return $next($request);
    }
}
