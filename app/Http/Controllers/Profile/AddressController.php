<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;

class UserAddressController extends Controller
{
    public function index()
    {
        $addresses = auth()->user()
            ->addresses()
            ->latest()
            ->get();

        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(StoreAddressRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();

        if (!empty($data['is_default'])) {
            $user->addresses()->update(['is_default' => false]);
        }

        $user->addresses()->create($data);

        return redirect()
            ->route('addresses.index')
            ->with('success', 'Endereço criado com sucesso.');
    }

    public function edit(Address $address)
    {
        $this->authorizeAddress($address);

        return view('addresses.edit', compact('address'));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $this->authorizeAddress($address);

        $data = $request->validated();

        $user = auth()->user();

        if (!empty($data['is_default'])) {
            $user->addresses()->update(['is_default' => false]);
        }

        $address->update($data);

        return redirect()
            ->route('addresses.index')
            ->with('success', 'Endereço atualizado com sucesso.');
    }

    public function destroy(Address $address)
    {
        $this->authorizeAddress($address);

        $address->delete();

        return redirect()
            ->route('addresses.index')
            ->with('success', 'Endereço removido com sucesso.');
    }

    private function authorizeAddress(Address $address): void
    {
        abort_unless(
            $address->user_id === auth()->id(),
            403
        );
    }
}