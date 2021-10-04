<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvenienceStoreCategory extends Model
{
    use HasFactory;

    public function convenience_stores()
    {
        return $this->hasMany(\App\Models\ConvenienceStore::class);
    }
}
