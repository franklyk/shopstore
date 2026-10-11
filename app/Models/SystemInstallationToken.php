<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemInstallationToken extends Model
{
    protected $fillable = [
        'system_installation_id',
        'token_hash',
        'revoked_at',
        'consumed_at',
    ];

    protected function casts(): array
    {
        return [
            'revoked_at' => 'datetime',
            'consumed_at' => 'datetime',
        ];
    }

    public function installation(): BelongsTo
    {
        return $this->belongsTo(SystemInstallation::class, 'system_installation_id');
    }
}
