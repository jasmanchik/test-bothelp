<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserEventType
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $xml_id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|UserEventType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEventType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEventType query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEventType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEventType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEventType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEventType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEventType whereXmlId($value)
 * @mixin \Eloquent
 */
class UserEventType extends Model
{
    use HasFactory;

    protected $fillable = [
        'xml_id',
        'name'
    ];
}
