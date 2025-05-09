<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 *
 *
 * @property int $id
 * @property string $alias
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modelgets\Component> $components
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
    use HasFactory;

    protected $fillable = ['alias'];

    /**
     * Get the components for the simulation.
     */
    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class, table: 'simulation_components')->withPivot(['x', 'y']);
    }

    /**
     * Returns the effects of a position in the current simulation.
     *
     * @return Collection<Effect>|null
     */
    public function getPositionEffects(int $x, int $y): Collection|null
    {
        /** @var Component|null $positionalComponent */
        $positionalComponent = $this->components()->wherePivot('x', $x)->wherePivot('y',$y)->first();

        return $positionalComponent?->effects()->withPivot('value')->get();
    }

    /**
     * Returns the total summarized effects of the current simulation.
     * @return array<string, float>
     */
    public function getGridEffects(): array
    {
        $components = $this->components()->get();

        $effects = Collection::empty();

        foreach ($components as $component) {
            /** @var Component $component */
            $effects->add($component->effects);
        }

        $effects = $effects->flatten()->groupBy('name');
        $appliedEffects = [];

        foreach ($effects as $effect) {
            /** @var Collection<Effect> $effect */
            $value = $effect->reduce(function (?float $carry, Effect $effect) {
                return $effect->pivot->value + $carry;
            });

            $appliedEffects += [$effect->first()->name => $value];
        }

        return $appliedEffects;
    }
}
