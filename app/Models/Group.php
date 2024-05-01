<?php

namespace App\Models;

use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Группа.
 *
 * @property integer $id
 * @property string  $title
 * @property integer $students_count
 * @property string  $headman_email
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 */
class Group extends Model
{
    use SoftDeletes, Filterable;

    const MAX_COURSES = 5;

    protected $fillable = [
        'title',
        'students_count',
        'headman_email',
        'user_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(
            Activity::class,
            'activities_groups',
            'group_id',
            'activity_id'
        )->withPivot(['students_count']);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'group_id', 'id');
    }

    public function getNextCourseTitle(): string
    {
        [$name, $number] = explode('-', $this->title);
        $course = intdiv($number, 10);

        if ($course < self::MAX_COURSES) {
            $course++;
        }

        $number[0] = $course;

        return $name . '-' . $number;
    }
}
