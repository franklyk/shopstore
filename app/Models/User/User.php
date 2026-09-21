<?php

namespace App\Models\User;

use App\Models\Cart\Cart;
use App\Models\Status\Status;
use App\Models\Traits\HasUuid;
use Database\Factories\User\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

// #[Fillable(['uuid', 'name', 'email', 'phone', 'password'])]
// #[Hidden(['password', 'remember_token'])]

class User extends Authenticatable implements MustVerifyEmail
{
    protected $fillable = [
        'uuid',
        'avatar',
        'name',
        'email',
        'phone',
        'status_id',
        'email_verified_at',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, HasUuid, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function maskedEmail(): string
    {
        [$name, $domain] = explode('@', $this->email, 2);

        if (strlen($name) <= 2) {
            return substr($name, 0, 1) . '***@' . $domain;
        }

        return substr($name, 0, 1)
            . str_repeat('*', strlen($name) - 2)
            . substr($name, -1)
            . '@' . $domain;
    }
}
