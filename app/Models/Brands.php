<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brands extends Model
{
    use HasFactory;

    protected $guarded =['id'];
    protected $with = ['category'];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
