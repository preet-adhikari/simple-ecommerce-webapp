<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function billCategory(): BelongsTo
    {
        return $this->belongsTo(BillCategory::class,'bill_category_id');
    }
}
