<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'name',
        'slug',
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
