<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventEffect extends Model
{
    protected $fillable = [
        'event_id',
        'effect_id',
        'value',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function effect(): BelongsTo
    {
        return $this->belongsTo(Effect::class);
    }
}
