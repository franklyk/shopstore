<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    /**
     * Tela de aviso de verificação.
     */
    public function notice()
    {
        return view('auth.verify-email');
    }

    /**
     * Verifica email do usuário.
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()
            ->route('home')
            ->with('success', 'Email verificado com sucesso!');
    }

    /**
     * Reenvia link de verificação.
     */
    public function send(Request $request)
    {
        $request->user()
            ->sendEmailVerificationNotification();

        return back()->with(
            'success',
            'Novo link de verificação enviado!'
        );
    }
}