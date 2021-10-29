<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['slug'];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function description(): HasMany
    {
        return $this->hasMany(CategoryDescription::class, 'categoryId', 'id');
    }

    public function events() {
        return $this->hasMany(Event::class, 'categoryId', 'id');
    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->description()->where('language', '=', $language)->first();
    }
}
