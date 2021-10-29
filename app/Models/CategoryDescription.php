<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryDescription extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'language', 'categoryId'];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
}
