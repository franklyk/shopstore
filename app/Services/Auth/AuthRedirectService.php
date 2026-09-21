<?php

namespace App\Services\Auth;

use App\Models\User\User;

class AuthRedirectService
{
    public function redirectFor(User $user): string
    {
        if ($user->is_employee) {
            return route('admin.dashboard');
        }

        return route('home');
    }
}
