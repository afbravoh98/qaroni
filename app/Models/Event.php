<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'slug',
        'capacity',
        'categoryId'
    ];

    public function description(): HasMany
    {
        return $this->hasMany(EventDescription::class, 'eventId', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->description()->where('language', '=', $language)->first();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'eventId', 'id');
    }

}
