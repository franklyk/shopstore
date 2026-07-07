<?php

namespace App\Models\Status;

use App\Models\Traits\HasUuid;
use Database\Factories\Status\StatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /** @use HasFactory<StatusFactory> */
    use HasFactory, HasUuid;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
