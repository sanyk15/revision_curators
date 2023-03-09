<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Activity
 *
 * @property              $id
 * @property              $activity_kind_id
 * @property              $benchmark_id
 * @property              $indicator_id
 * @property              $curator_id
 * @property              $group_id
 * @property              $date
 * @property              $threshold
 * @property              $assessment_frequency
 * @property              $possible_score
 * @property              $curator_score
 * @property              $created_at
 * @property              $updated_at
 * @property              $deleted_at
 *
 * @property ActivityKind $activityKind
 * @property Benchmark    $benchmark
 * @property Curator      $curator
 * @property Group        $group
 * @property Indicator    $indicator
 * @package App
 * @mixin Builder
 */
class Activity extends Model
{
    use SoftDeletes;

    static $rules = [
        'activity_kind_id' => 'required',
        'curator_id'       => 'required',
        'group_id'         => 'required',
        'date'             => 'required',
        'possible_score'   => 'required',
        'curator_score'    => 'required',
    ];

    protected $fillable = [
        'activity_kind_id',
        'benchmark_id',
        'indicator_id',
        'curator_id',
        'group_id',
        'date',
        'threshold',
        'assessment_frequency',
        'possible_score',
        'curator_score',
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

    public function curator(): HasOne
    {
        return $this->hasOne(Curator::class, 'id', 'curator_id');
    }

    public function group(): HasOne
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function indicator(): HasOne
    {
        return $this->hasOne(Indicator::class, 'id', 'indicator_id');
    }
}
