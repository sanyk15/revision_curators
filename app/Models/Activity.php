<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Spatie\CalendarLinks\Link;

/**
 * Class Activity
 *
 * @property integer      $id
 * @property integer      $activity_kind_id
 * @property integer      $benchmark_id
 * @property integer      $indicator_id
 * @property integer      $user_id
 * @property Carbon       $date
 * @property string       $threshold
 * @property string       $assessment_frequency
 * @property string       $possible_score
 * @property integer      $curator_score
 * @property Carbon       $created_at
 * @property Carbon       $updated_at
 * @property Carbon       $deleted_at
 * @property string       $title
 * @property array        $group_ids
 *
 * @property ActivityKind $activityKind
 * @property Benchmark    $benchmark
 * @property User         $user
 * @property Indicator    $indicator
 * @property Collection   $groups
 * @mixin Builder
 */
class Activity extends Model
{
    use SoftDeletes, Filterable;

    static $rules = [
        'activity_kind_id' => 'required',
        'group_ids' => 'array',
        'date' => 'required',
        'possible_score' => 'required',
        'curator_score' => 'required',
        'title' => 'required',
        'user_id' => 'required',
    ];

    protected $fillable = [
        'activity_kind_id',
        'benchmark_id',
        'indicator_id',
        'user_id',
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

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'activities_groups', 'activity_id', 'group_id');
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

    /**
     * Ссылка на создание ивента в google календаре
     *
     * @return string
     */
    public function getCalendarLinkAttribute(): string
    {
        return Link::create(
            $this->title,
            $this->date,
            $this->date->addHour(),
        )->google();
    }
}
