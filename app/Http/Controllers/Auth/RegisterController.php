<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Notifications\EmailVerificationCodeNotification;
use App\Services\EmailVerificationService;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(
        RegisterRequest $request,
        EmailVerificationService $verificationService
    ) {
        $user = User::create($request->validated());

        $user->assignRole('customer');

        Auth::login($user);

        $code = $verificationService->create($user);

        $user->notify(
            new EmailVerificationCodeNotification($code)
        );

        return redirect()
            ->route('verification.notice')
            ->with('success', 'Conta criada! Verifique seu e-mail.');
    }
}
