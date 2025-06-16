<?php

namespace App\Models;

use Database\Factories\EventFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Effect> $effects
 * @property-read int|null $effects_count
 * @method static EventFactory factory($count = null, $state = [])
 * @method static Builder<static>|Event newModelQuery()
 * @method static Builder<static>|Event newQuery()
 * @method static Builder<static>|Event query()
 * @method static Builder<static>|Event whereCreatedAt($value)
 * @method static Builder<static>|Event whereId($value)
 * @method static Builder<static>|Event whereName($value)
 * @method static Builder<static>|Event whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function effects(): BelongsToMany
    {
        return $this->belongsToMany(Effect::class, 'event_effects')->withPivot('value');
    }
}
