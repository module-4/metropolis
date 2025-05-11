<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $category
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|ComponentNotification newModelQuery()
 * @method static Builder<static>|ComponentNotification newQuery()
 * @method static Builder<static>|ComponentNotification query()
 * @method static Builder<static>|ComponentNotification whereCategory($value)
 * @method static Builder<static>|ComponentNotification whereCreatedAt($value)
 * @method static Builder<static>|ComponentNotification whereId($value)
 * @method static Builder<static>|ComponentNotification whereName($value)
 * @method static Builder<static>|ComponentNotification whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ComponentNotification extends Model
{

}
