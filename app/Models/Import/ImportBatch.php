<?php

namespace App\Models\Import;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportBatch extends Model
{
    /** @use HasFactory<\Database\Factories\ImportBatchFactory> */
    use HasFactory;

    protected $fillable = [
        'file_path',
        'original_name',
        'status',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
