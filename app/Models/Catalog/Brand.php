<?php

namespace App\Models\Catalog;

use App\Models\Status\Status;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasUuid;
use Database\Factories\Catalog\BrandFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    /** @use HasFactory<BrandFactory> */
    use HasFactory;
    use HasSlug;
    use HasUuid;
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'website',
        'logo',
        'status_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
