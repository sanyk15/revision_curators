<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class ActivityType
 *
 * @property integer      $id
 * @property integer      $activity_kind_id
 * @property integer      $benchmark_id
 * @property integer      $indicator_id
 * @property string       $threshold
 * @property string       $assessment_frequency
 * @property string       $possible_score
 * @property integer      $curator_score
 * @property Carbon       $created_at
 * @property Carbon       $updated_at
 * @property Carbon       $deleted_at
 * @property string       $title
 * @property string       $code
 *
 * @property ActivityKind $activityKind
 * @property Benchmark    $benchmark
 * @property Indicator    $indicator
 * @mixin Builder
 */
class ActivityType extends Model
{
    use SoftDeletes, Filterable;

    const ADDITIONAL_EVENT_TYPE_CODE = 'dopolnitelnoe';

    static $rules = [
        'title' => 'required',
    ];

    protected $fillable = [
        'activity_kind_id',
        'benchmark_id',
        'indicator_id',
        'threshold',
        'assessment_frequency',
        'possible_score',
        'curator_score',
        'title',
        'code',
    ];

    public function activityKind(): HasOne
    {
        return $this->hasOne(ActivityKind::class, 'id', 'activity_kind_id');
    }

    public function benchmark(): HasOne
    {
        return $this->hasOne(Benchmark::class, 'id', 'benchmark_id');
    }

    public function indicator(): HasOne
    {
        return $this->hasOne(Indicator::class, 'id', 'indicator_id');
    }
}
