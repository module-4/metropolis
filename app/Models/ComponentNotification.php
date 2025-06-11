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
 * @property int $component_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Component $component
 * @method static Builder<static>|ComponentNotification newModelQuery()
 * @method static Builder<static>|ComponentNotification newQuery()
 * @method static Builder<static>|ComponentNotification query()
 * @method static Builder<static>|ComponentNotification whereComponentId($value)
 * @method static Builder<static>|ComponentNotification whereCreatedAt($value)
 * @method static Builder<static>|ComponentNotification whereId($value)
 * @method static Builder<static>|ComponentNotification whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ComponentNotification extends Model
{
    protected $fillable = ['component_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the component that owns the notification.
     */
    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class)->withTrashed();
    }
}
