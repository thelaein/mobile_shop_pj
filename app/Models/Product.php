<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function model()
    {
        return $this->belongsTo('App\Models\ProductModel');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
}
