<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Вид деятельности.
 *
 * @property integer $id
 * @property string $title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class ActivityKind extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
