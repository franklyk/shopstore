<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Status;
use App\Traits\HasSlug;
use App\Traits\HasUuid;
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

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
