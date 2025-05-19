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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentBlockList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentBlockList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentBlockList query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentBlockList whereComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentBlockList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentBlockList whereEffectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentBlockList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentBlockList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComponentBlockList whereValue($value)
 * @mixin \Eloquent
 */
class ComponentBlockList extends Model
{
    /**
     * Ensure used table is 'component_blocklist' instead of **list(s) (plural)
     */
    protected $table = 'component_blocklist';

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
