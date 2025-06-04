<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $component_id
 * @property int $effect_id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Component $component
 * @property-read \App\Models\Effect $effect
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentEffect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentEffect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentEffect query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentEffect whereComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentEffect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentEffect whereEffectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentEffect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentEffect whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentEffect whereValue($value)
 * @mixin \Eloquent
 */
class ComponentEffect extends Model
{
    protected $fillable = [
        'component_id',
        'effect_id',
        'value',
    ];

    /**
     * Get the component that owns the ComponentEffect.
     */
    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    /**
     * Get the effect that owns the ComponentEffect.
     */
    public function effect(): BelongsTo
    {
        return $this->belongsTo(Effect::class);
    }
}
