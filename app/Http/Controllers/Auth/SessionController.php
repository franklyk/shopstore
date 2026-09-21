<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SessionRequest;
use App\Services\Auth\AuthRedirectService;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
    SessionRequest $request,
    AuthRedirectService $authRedirect
) {
    $credentials = $request->validated();

    $remember = $request->boolean('remember');

    unset($credentials['remember']);

    if (!Auth::attempt($credentials, $remember)) {
        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ])->onlyInput('email');
    }

    $request->session()->regenerate();

    return redirect()->to(
        $authRedirect->redirectFor(Auth::user())
    );
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home');
    }
}
