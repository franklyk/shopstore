<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Address\StoreAddressRequest;
use App\Models\Address;
use App\Http\Requests\User\Address\UpdateAddressRequest;

use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        // $addresses = auth()->user()
        $addresses = Auth::user()
            ->addresses()
            ->latest()
            ->get();

        return view('profile.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('profile.addresses.create');
    }

    public function store(StoreAddressRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        if (!empty($data['is_default'])) {
            $user->addresses()->update(['is_default' => false]);
        }

        $user->addresses()->create($data);

        return redirect()
            ->route('profile.addresses.index')
            ->with('success', 'Endereço criado com sucesso.');
    }

    public function edit(Address $address)
    {
        $this->authorizeAddress($address);

        return view('profile.addresses.edit', compact('address'));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $this->authorizeAddress($address);

        $data = $request->validated();

        $user = Auth::user();

        if (!empty($data['is_default'])) {
            $user->addresses()->update(['is_default' => false]);
        }

        $address->update($data);

        return redirect()
            ->route('profile.addresses.index')
            ->with('success', 'Endereço atualizado com sucesso.');
    }

    public function destroy(Address $address)
    {
        $this->authorizeAddress($address);

        $address->delete();

        return redirect()
            ->route('profile.addresses.index')
            ->with('success', 'Endereço removido com sucesso.');
    }

    private function authorizeAddress(Address $address): void
    {
        abort_unless(
            $address->user_id === Auth::id(),
            403
        );
    }
}