<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class FirstLoginPasswordController extends Controller
{
    public function edit(): View|RedirectResponse
    {
        $user = request()->user();

        if (!$user->must_change_password) {
            return redirect()->route('home');
        }

        return view('auth.first-login-password');
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(12),
            ],
        ], [
            'current_password.current_password' => 'A senha provisória está incorreta.',
            'password.confirmed' => 'A confirmação da nova senha não confere.',
            'password.min' => 'A nova senha deve ter pelo menos 12 caracteres.',
        ]);

        $user->forceFill([
            'password' => Hash::make($data['password']),
            'must_change_password' => false,
        ])->save();

        return redirect()
            ->route($user->is_employee ? 'admin.dashboard' : 'home')
            ->with('success', 'Senha alterada com sucesso.');
    }
}
