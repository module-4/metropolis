<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property int $component_id
 * @property int $blocked_component_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Component $component
 * @property-read \App\Models\Component $blocked_component
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockList query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockList whereComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockList whereEffectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockList whereValue($value)
 * @mixin \Eloquent
 */
class BlockList extends Model
{
    protected $fillable = [
        'component_id',
        'blocked_component_id'
    ];

    /**
     * Get the component.
     */
    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    /**
     * Get the blocked component.
     */
    public function blockedComponent(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }
}
