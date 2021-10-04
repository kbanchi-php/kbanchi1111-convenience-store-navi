<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvenienceStore extends Model
{
    use HasFactory;

    public function convenience_store_category()
    {
        return $this->belongsTo(\App\Models\ConvenienceStoreCategory::class);
    }
}
