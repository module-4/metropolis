<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $simulation_id
 * @property int $component_id
 * @property int $position
 * @property-read \App\Models\Component $component
 * @property-read \App\Models\Simulation $simulation
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimulationComponent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimulationComponent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimulationComponent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimulationComponent whereComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimulationComponent wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SimulationComponent whereSimulationId($value)
 * @mixin \Eloquent
 */
class SimulationComponent extends Model
{
    protected $fillable = [
        'simulation_id',
        'component_id',
        'position',
    ];

    public $timestamps = false;

    public function simulation(): BelongsTo
    {
        return $this->belongsTo(Simulation::class);
    }

    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }
}
