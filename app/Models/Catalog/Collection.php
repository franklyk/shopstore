<?php

namespace App\Models\Catalog;

use App\Models\Supplier\Supplier;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory, HasSlug, HasUuid, SoftDeletes;

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
