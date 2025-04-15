<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Effect withoutTrashed()
 * @mixin \Eloquent
 */
class Effect extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];
}
