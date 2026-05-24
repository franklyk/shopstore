<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Formulário de solicitação de redefinição.
     */
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Envia email de redefinição.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent

            ? back()->with([
                'success' => 'Link de redefinição enviado com sucesso!'
            ])

            : back()->withErrors([
                'email' => __($status)
            ]);
    }

    /**
     * Formulário de redefinição.
     */
    public function resetPassword(string $token)
    {
        return view('auth.reset-password', [
            'token' => $token
        ]);
    }

    /**
     * Atualiza senha.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $status = Password::reset(

            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),

            function (User $user, string $password) {

                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }

        );

        return $status === Password::PasswordReset

            ? redirect()
                ->route('login.create')
                ->with('success', 'Senha redefinida com sucesso!')

            : back()->withErrors([
                'email' => [__($status)]
            ]);
    }
}