<?php

namespace App\Models;

use App\Models\Position;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }
}
