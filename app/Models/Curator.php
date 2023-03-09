<?php

namespace App\Models;

use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Куратор.
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $surname
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Curator extends Model
{
    use SoftDeletes, Filterable;

    protected $fillable = [
        'first_name',
        'last_name',
        'surname',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getFullNameAttribute(): string
    {
        $fullName = $this->last_name . ' ' . $this->first_name;
        $fullName .= $this->surname ? ' ' . $this->surname : '';

        return $fullName;
    }

    public function getSurnameAndInitialsAttribute(): string
    {
        $fullName = $this->last_name . ' ' . mb_substr($this->first_name, 0, 1);
        $fullName .= $this->surname ? '. ' . mb_substr($this->surname, 0, 1) . '.' : '';

        return $fullName;
    }
}
