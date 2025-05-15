<?php

namespace App\Models;

use App\Events\ComponentCreated;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $image_name
 * @property int $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read \App\Models\Category $category
 * @property-read Collection<int, \App\Models\Effect> $effects
 * @property-read int|null $effects_count
 * @property-read Collection<int, \App\Models\ComponentNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\ComponentFactory factory($count = null, $state = [])
 * @method static Builder<static>|Component newModelQuery()
 * @method static Builder<static>|Component newQuery()
 * @method static Builder<static>|Component onlyTrashed()
 * @method static Builder<static>|Component query()
 * @method static Builder<static>|Component whereCategoryId($value)
 * @method static Builder<static>|Component whereCreatedAt($value)
 * @method static Builder<static>|Component whereDeletedAt($value)
 * @method static Builder<static>|Component whereId($value)
 * @method static Builder<static>|Component whereImageName($value)
 * @method static Builder<static>|Component whereName($value)
 * @method static Builder<static>|Component whereUpdatedAt($value)
 * @method static Builder<static>|Component withTrashed()
 * @method static Builder<static>|Component withoutTrashed()
 * @mixin Eloquent
 */
class Component extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name', 'image_name', 'category_id'];

    protected $dispatchesEvents = [
        'created' => ComponentCreated::class,
    ];

    /**
     * Get the category that owns the component.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function effects(): BelongsToMany
    {
        return $this->belongsToMany(Effect::class, 'component_effects')->withPivot('value');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(ComponentNotification::class);
    }
}
