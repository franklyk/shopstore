<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Address\StoreAddressRequest;
use App\Http\Requests\User\Address\UpdateAddressRequest;
use App\Models\Address;
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

        if (! empty($data['is_default'])) {
            $user->addresses()->update(['is_default' => false]);
        }

        $user->addresses()->create($data);

        return redirect()
            ->route('profile.addresses.index')
            ->with('success', 'Endereço criado com sucesso.');
    }

    public function edit(Address $address)
    {
        $this->authorize('update', $address);

        return view('profile.addresses.edit', compact('address'));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {

        $this->authorize('update', $address);

        $data = $request->validated();

        $user = Auth::user();

        if (! empty($data['is_default'])) {
            $user->addresses()->update(['is_default' => false]);
        }

        $address->update($data);

        return redirect()
            ->route('profile.addresses.index')
            ->with('success', 'Endereço atualizado com sucesso.');
    }

    public function destroy(Address $address)
    {

        $this->authorize('delete', $address);

        $address->delete();

        return redirect()
            ->route('profile.addresses.index')
            ->with('success', 'Endereço removido com sucesso.');
    }
}
