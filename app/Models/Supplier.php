<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use App\Models\Traits\HasSlug;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, HasUuid, HasSlug, SoftDeletes;

    protected $fillable = [
        'name',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }
}
