<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Benchmark
 *
 * @property $id
 * @property $title
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin Builder
 */
class Benchmark extends Model
{
    use SoftDeletes;

    static $rules = [
		'title' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['title'];
}
