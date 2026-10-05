<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Traits\HasUuid;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
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

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
