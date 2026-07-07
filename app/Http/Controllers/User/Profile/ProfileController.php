<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user();

        //     $defaultAddress = $user->addresses()
        // ->where('is_default', true)
        // ->first();

        return view('profile.show', compact('user'));
    }


    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $user->update(
            $request->validated()
        );

        return redirect()
            ->route('profile.show')
            ->with('success', 'Perfil atualizado com sucesso.');
    }


    public function destroy()
    {
        //
    }
}
