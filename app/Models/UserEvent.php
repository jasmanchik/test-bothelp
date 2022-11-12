<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserEvent
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $event_id
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereUserId($value)
 * @mixin \Eloquent
 */
class UserEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_id'
    ];
}
