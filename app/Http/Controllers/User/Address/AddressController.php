<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Address\StoreAddressRequest;
use App\Http\Requests\User\Address\UpdateAddressRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()
            ->addresses()
            ->latest()
            ->paginate(10);

        return view(
            'profile.addresses.index',
            compact('addresses')
        );
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
            $this->clearDefaultAddresses($user);
        }

        if ($user->addresses()->count() === 0) {
            $data['is_default'] = true;
        }

        $user->addresses()->create($data);

        return redirect()
            ->route('profile.addresses.index')
            ->with('success', 'Endereço criado com sucesso.');
    }

    public function edit(Address $address)
    {
        $this->authorize('update', $address);

        return view(
            'profile.addresses.edit',
            compact('address')
        );
    }

    public function update(
        UpdateAddressRequest $request,
        Address $address
    ) {
        $this->authorize('update', $address);

        $data = $request->validated();

        $user = Auth::user();

        if (! empty($data['is_default'])) {
            $this->clearDefaultAddresses($user);
        }

        $address->update($data);

        return redirect()
            ->route('profile.addresses.index')
            ->with('success', 'Endereço atualizado com sucesso.');
    }

    public function destroy(Address $address)
    {
        $this->authorize('delete', $address);

        $user = Auth::user();

        $wasDefault = $address->is_default;

        $address->delete();

        if ($wasDefault) {

            $newDefault = $user->addresses()
                ->latest()
                ->first();

            if ($newDefault) {
                $newDefault->update([
                    'is_default' => true,
                ]);
            }
        }

        return redirect()
            ->route('profile.addresses.index')
            ->with('success', 'Endereço removido com sucesso.');
    }

    private function clearDefaultAddresses(User $user): void
    {
        $user->addresses()->update([
            'is_default' => false,
        ]);
    }

    public function setDefault(Address $address)
    {
        $this->authorize('update', $address);

        $user = Auth::user();

        $user->addresses()->update([
            'is_default' => false,
        ]);

        $address->update([
            'is_default' => true,
        ]);

        return redirect()
            ->route('profile.addresses.index')
            ->with('success', 'Endereço principal atualizado.');
    }
}
