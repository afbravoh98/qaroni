<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventDescription extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'language', 'eventId'];

    public function event() : BelongsTo
    {
        return $this->belongsTo(Event::class, 'eventId');
    }
}
