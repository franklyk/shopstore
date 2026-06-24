<?php

namespace App\Models;


use App\Models\Traits\HasUuid;
use App\Models\Traits\HasSlug;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory, HasUuid, HasSlug, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'name',
        'year',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }
}
