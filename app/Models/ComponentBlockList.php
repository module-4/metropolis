<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Thiagoprz\CompositeKey\HasCompositeKey;

/**
 *
 *
 * @property int $component_id
 * @property int $blocked_component_id
 * @property-read Component $blockedComponent
 * @property-read Component $component
 * @method static Builder<static>|ComponentBlockList newModelQuery()
 * @method static Builder<static>|ComponentBlockList newQuery()
 * @method static Builder<static>|ComponentBlockList query()
 * @method static Builder<static>|ComponentBlockList whereBlockedComponentId($value)
 * @method static Builder<static>|ComponentBlockList whereComponentId($value)
 * @mixin Eloquent
 */
class ComponentBlockList extends Model
{
    use HasCompositeKey;

    public $timestamps = false;
    public $incrementing = false;
    /**
     * Ensure used table is 'component_blocklist' instead of **list(s) (plural)
     */
    protected $table = 'component_blocklist';
    protected $primaryKey = ['component_id', 'blocked_component_id'];
    protected $keyType = 'int';

    protected $fillable = [
        'component_id',
        'blocked_component_id'
    ];

    /**
     * Get the component.
     */
    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class)->withTrashed();
    }

    /**
     * Get the blocked component.
     */
    public function blockedComponent(): BelongsTo
    {
        return $this->belongsTo(Component::class)->withTrashed();
    }
}
