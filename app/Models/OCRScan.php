<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OCRScan extends Model
{
    use HasFactory;

    protected $table = 'ocr_scans';

    protected $fillable = [
        'hash',
        'data',
        'user_id',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
