<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SystemInstallation extends Model
{
    protected $fillable = [
        'uuid',
        'status',
        'initialized_at',
    ];

    protected function casts(): array
    {
        return [
            'initialized_at' => 'datetime',
        ];
    }

    public function tokens(): HasMany
    {
        return $this->hasMany(SystemInstallationToken::class);
    }
}
