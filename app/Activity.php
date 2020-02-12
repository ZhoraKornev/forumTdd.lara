<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Activity
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $subject
 * @property int $id
 * @property int $user_id
 * @property string $subject_type
 * @property string $type
 * @property int $subject_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereUserId($value)
 * @method static count()
 */
class Activity extends Model
{
    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * @param User|Authenticatable $user
     * @param int $take
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection|void
     */
    public static function feed(User $user,$take = 50)
    {

        return static::whereUserId($user->id)->latest()->with('subject')->take($take)->get()->groupBy(function ($activity){
            return $activity->created_at->format('Y-m-d');
        });
    }
}
