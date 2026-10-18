<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResendEmailVerificationCodeRequest;
use App\Http\Requests\VerifyEmailCodeRequest;
use App\Models\SystemInstallation;
use App\Models\User;
use App\Notifications\EmailVerificationCodeNotification;
use App\Services\EmailVerificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationCodeController extends Controller
{
    public function __construct(
        private readonly EmailVerificationService $verificationService
    ) {}

    public function create(Request $request): View|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        return view('auth.verify-email-code', [
            'email' => $request->user()->maskedEmail(),
        ]);
    }


    public function store(
        VerifyEmailCodeRequest $request
    ): RedirectResponse {
        $user = $request->user();

        $this->verificationService->verify(
            $user,
            $request->validated('code')
        );

        if ($user->hasRole('owner')) {
            $installation = SystemInstallation::query()->firstOrFail();

            if ($installation->status === 'owner_verification') {
                $installation->update([
                    'status' => 'super_admin_setup',
                ]);
            }

            return redirect()
                ->route('admin.system.super-admin.create')
                ->with(
                    'success',
                    'E-mail confirmado. Cadastre agora a conta Super Admin.'
                );
        }

        return redirect()
            ->route('home')
            ->with('success', 'E-mail confirmado com sucesso.');
    }


    public function resend(
        ResendEmailVerificationCodeRequest $request
    ): RedirectResponse {
        /** @var User $user */
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        $code = $this->verificationService->create($user);

        $user->notify(
            new EmailVerificationCodeNotification($code)
        );

        return back()->with(
            'success',
            'Se a solicitação for válida, enviaremos um novo código de verificação.'
        );
    }
}
