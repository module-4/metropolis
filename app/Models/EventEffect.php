<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $event_id
 * @property int $effect_id
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Effect $effect
 * @property-read Event $event
 * @method static Builder<static>|EventEffect newModelQuery()
 * @method static Builder<static>|EventEffect newQuery()
 * @method static Builder<static>|EventEffect query()
 * @method static Builder<static>|EventEffect whereCreatedAt($value)
 * @method static Builder<static>|EventEffect whereEffectId($value)
 * @method static Builder<static>|EventEffect whereEventId($value)
 * @method static Builder<static>|EventEffect whereId($value)
 * @method static Builder<static>|EventEffect whereUpdatedAt($value)
 * @method static Builder<static>|EventEffect whereValue($value)
 * @mixin Eloquent
 */
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
