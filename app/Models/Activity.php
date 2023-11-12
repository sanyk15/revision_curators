<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class Activity
 *
 * @property              $id
 * @property              $activity_kind_id
 * @property              $benchmark_id
 * @property              $indicator_id
 * @property              $user_id
 * @property              $group_id
 * @property              $date
 * @property              $threshold
 * @property              $assessment_frequency
 * @property              $possible_score
 * @property              $curator_score
 * @property              $created_at
 * @property              $updated_at
 * @property              $deleted_at
 * @property              $title
 *
 * @property ActivityKind $activityKind
 * @property Benchmark    $benchmark
 * @property User         $user
 * @property Group        $group
 * @property Indicator    $indicator
 * @mixin Builder
 */
class Activity extends Model
{
    use SoftDeletes, Filterable;

    static $rules = [
        'activity_kind_id' => 'required',
        'group_id' => 'required',
        'date' => 'required',
        'possible_score' => 'required',
        'curator_score' => 'required',
    ];

    protected $fillable = [
        'activity_kind_id',
        'benchmark_id',
        'indicator_id',
        'user_id',
        'group_id',
        'date',
        'threshold',
        'assessment_frequency',
        'possible_score',
        'curator_score',
        'title',
    ];

    protected $dates = [
        'date',
    ];

    public function activityKind(): HasOne
    {
        return $this->hasOne(ActivityKind::class, 'id', 'activity_kind_id');
    }

    public function benchmark(): HasOne
    {
        return $this->hasOne(Benchmark::class, 'id', 'benchmark_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function group(): HasOne
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function indicator(): HasOne
    {
        return $this->hasOne(Indicator::class, 'id', 'indicator_id');
    }

    public static function getActivitiesForMonthByPeriod(Carbon $dateStart, Carbon $dateEnd): Collection
    {
        return Activity::query()
            ->whereBetween('date', [$dateStart, $dateEnd])
            ->get()
            ->map(function (Activity $activity) {
                return [
                    'id' => $activity->id,
                    'allDay' => true,
                    'start' => $activity->date,
                    'title' => $activity->title,
                    'url' => route('activities.show', $activity->id),
                ];
            });
    }
}
