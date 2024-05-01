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
 * Class Student
 *
 * @property integer $id
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $surname
 * @property Carbon  $birth_date
 * @property string  $phone
 * @property string  $email
 * @property string  $citizenship
 * @property integer $group_id
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 */
class Student extends Model
{
    use SoftDeletes, Filterable;

    static $rules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'birth_date' => 'required',
        'group_id'   => 'required',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'surname',
        'birth_date',
        'phone',
        'email',
        'citizenship',
        'group_id',
        'is_head',
    ];

    protected $dates = [
        'birth_date',
    ];

    public function group(): HasOne
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function getFullNameAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->surname;
    }

    public static function unsetHeadByGroup(int $groupId)
    {
        Student::query()->where('group_id', '=', $groupId)->update(['is_head' => 0]);
    }
}
