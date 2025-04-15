<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $image_name
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Effect> $effects
 * @property-read int|null $effects_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component whereImageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Component withoutTrashed()
 * @mixin \Eloquent
 */
class Component extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'image_name', 'category_id'];

    /**
     * Get the category that owns the component.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function effects(): HasManyThrough
    {
        return $this->hasManyThrough(Effect::class, ComponentEffect::class);
    }
}
