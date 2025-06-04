<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Thiagoprz\CompositeKey\HasCompositeKey;

/**
 *
 *
 * @property int $simulation_id
 * @property int $component_id
 * @property int $x
 * @property int $y
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
    public $timestamps = false;
    use HasCompositeKey;


    protected $primaryKey = ['simulation_id', 'x', "y"];
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'simulation_id',
        'component_id',
        'x',
        'y'
    ];

    public function simulation(): BelongsTo
    {
        return $this->belongsTo(Simulation::class);
    }

    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    public function getNeighbors()
    {
        $neighbors = [];

        // Offset of coordinates for all neighbors based on current position
        $offsets = [
            [-1, -1], [0, -1], [1, -1],
            [1, 0], [1, 1], [0, 1],
            [-1, 1], [-1, 0],
        ];

        foreach ($offsets as [$dx, $dy]) {
            $x = $this->x + $dx;
            $y = $this->y + $dy;

            $neighbor = SimulationComponent::find([
                $this->simulation->id,
                $x,
                $y
            ]);

            if (!$neighbor) {
                continue;
            }

            $neighbors[] = [
                'id' => $neighbor->component_id,
                'x' => $neighbor->x,
                'y' => $neighbor->y,
                'effects' => $neighbor->component->effects->map(function ($effect) {
                    return [
                        $effect->name => $effect->pivot->value
                    ];
                })
            ];

        }

        return $neighbors;
    }

    public function isApproved(): bool {
        return SimulationComponent::find([$this->simulation_id, $this->x, $this->y])->approved;
    }


}
