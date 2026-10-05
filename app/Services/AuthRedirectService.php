<?php

namespace App\Services;

use App\Models\User;

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
