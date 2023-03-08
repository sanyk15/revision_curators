<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AdditionalEvent
 *
 * @property $id
 * @property $title
 * @property $date
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin Builder
 */
class AdditionalEvent extends Model
{
    use SoftDeletes;

    static $rules = [
		'title' => 'required',
		'date' => 'required',
    ];

    protected $fillable = ['title','date'];
}
