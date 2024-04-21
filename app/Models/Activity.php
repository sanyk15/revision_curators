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
 * @property ActivityType $type
 * @mixin Builder
 */
class Activity extends Model
{
    use SoftDeletes, Filterable;

    const MY_COLOR = '#9ACD32';
    const MAIN_COLOR = '#6495ED';
    const SENT_STUDENTS_COLOR = '#DAA520';

    static $rules = [
        'group_ids' => 'array',
        'date' => 'required',
        'title' => 'required',
        'user_id' => 'required',
        'students_quota' => 'required',
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
        'type_id',
        'students_quota',
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
        return $this->belongsToMany(
            Group::class,
            'activities_groups',
            'activity_id',
            'group_id'
        )->withPivot(['students_count']);
    }

    public function indicator(): HasOne
    {
        return $this->hasOne(Indicator::class, 'id', 'indicator_id');
    }

    public function type(): HasOne
    {
        return $this->hasOne(ActivityType::class, 'id', 'type_id');
    }

    public static function getActivitiesForMonthByPeriod(Carbon $dateStart, Carbon $dateEnd): Collection
    {
        $groupIds = auth()->user()->groups->pluck('id')->toArray();

        return Activity::query()
            ->whereBetween('date', [$dateStart, $dateEnd])
            ->with('groups')
            ->get()
            ->map(function (Activity $activity) use ($groupIds) {
                $color = self::MAIN_COLOR;

                if (auth()->user()->id == $activity->user_id) {
                    $color = self::MY_COLOR;
                } else if (array_intersect($activity->groups->pluck('id')->toArray(), $groupIds)) {
                    $color = self::SENT_STUDENTS_COLOR;
                }

                return [
                    'id' => $activity->id,
                    'allDay' => true,
                    'start' => $activity->date,
                    'title' => $activity->title,
                    'url' => route('activities.show', $activity->id),
                    'color' => $color,
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

    public function fillByType()
    {
        $type = $this->type;

        $this->activity_kind_id = $type->activity_kind_id;
        $this->benchmark_id = $type->benchmark_id;
        $this->indicator_id = $type->indicator_id;
        $this->threshold = $type->threshold;
        $this->assessment_frequency = $type->assessment_frequency;
        $this->possible_score = $type->possible_score;
        $this->curator_score = $type->curator_score;
    }

    public function getActualStudentsCountAttribute()
    {
        return $this->groups->sum('pivot.students_count');
    }
}
