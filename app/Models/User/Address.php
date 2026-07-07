<?php

namespace App\Models\User;

use Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /** @use HasFactory<AddressFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'cep',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
