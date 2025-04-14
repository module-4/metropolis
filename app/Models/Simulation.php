<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $alias
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Component> $components
 * @property-read int|null $components_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simulation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simulation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simulation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simulation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simulation whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simulation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simulation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simulation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simulation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simulation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Simulation withoutTrashed()
 * @mixin \Eloquent
 */
class Simulation extends Model
{
    use SoftDeletes;

    protected $fillable = ['alias'];

    /**
     * Get the components for the simulation.
     */
    public function components(): HasManyThrough
    {
        return $this->hasManyThrough(Component::class, SimulationComponent::class);
    }
}
