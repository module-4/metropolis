<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $fillable = ["name"];

    public function effects(): BelongsToMany
    {
        return $this->belongsToMany(Effect::class, 'event_effects')->withPivot('value');
    }
}
