<?php

namespace App\Services;

use App\Models\EmailVerificationCode;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class EmailVerificationService
{
    private const EXPIRATION_MINUTES = 10;
    private const MAX_ATTEMPTS = 5;
    private const RESEND_COOLDOWN_SECONDS = 60;

    public function create(User $user): string
    {
        if ($user->hasVerifiedEmail()) {
            throw ValidationException::withMessages([
                'code' => 'Este endereço de e-mail já foi confirmado.',
            ]);
        }

        return DB::transaction(function () use ($user) {
            $latestCode = EmailVerificationCode::query()
                ->where('user_id', $user->id)
                ->lockForUpdate()
                ->latest('id')
                ->first();

            if (
                $latestCode &&
                $latestCode->created_at->gt(
                    now()->subSeconds(self::RESEND_COOLDOWN_SECONDS)
                )
            ) {
                throw ValidationException::withMessages([
                    'code' => 'Aguarde um minuto antes de solicitar outro código.',
                ]);
            }

            EmailVerificationCode::query()
                ->where('user_id', $user->id)
                ->whereNull('consumed_at')
                ->delete();

            $code = (string) random_int(100000, 999999);

            EmailVerificationCode::create([
                'user_id' => $user->id,
                'code_hash' => Hash::make($code),
                'attempts' => 0,
                'expires_at' => now()->addMinutes(self::EXPIRATION_MINUTES),
            ]);

            return $code;
        });
    }

    public function verify(User $user, string $code): void
    {
        $result = DB::transaction(function () use ($user, $code) {
            $verificationCode = EmailVerificationCode::query()
                ->where('user_id', $user->id)
                ->whereNull('consumed_at')
                ->lockForUpdate()
                ->latest('id')
                ->first();

            if (!$verificationCode || $verificationCode->expires_at->isPast()) {
                return 'expired';
            }

            if ($verificationCode->attempts >= self::MAX_ATTEMPTS) {
                return 'locked';
            }

            if (!Hash::check($code, $verificationCode->code_hash)) {
                $verificationCode->increment('attempts');

                return 'invalid';
            }

            $verificationCode->update([
                'consumed_at' => now(),
            ]);

            $user->forceFill([
                'email_verified_at' => now(),
            ])->save();

            return 'verified';
        });

        if ($result === 'expired' || $result === 'locked') {
            throw ValidationException::withMessages([
                'code' => 'O código é inválido ou expirou. Solicite um novo código.',
            ]);
        }

        if ($result === 'invalid') {
            throw ValidationException::withMessages([
                'code' => 'O código informado está incorreto.',
            ]);
        }
    }
}
