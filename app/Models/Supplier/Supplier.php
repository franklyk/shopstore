<?php

namespace App\Models\Supplier;

use App\Models\Catalog\Product;
use App\Models\Status\Status;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, HasSlug, HasUuid, SoftDeletes;

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

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
