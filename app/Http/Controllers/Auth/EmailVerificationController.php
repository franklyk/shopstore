<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{


    public function notice(Request $request)
    {
        return view('auth.verify-email', [
            'user' => $request->user(),
        ]);
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
