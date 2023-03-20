<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class ActivityFilter extends ModelFilter
{
    public function search(string $string): ActivityFilter
    {
        if ($string) {
            return $this
                ->where('date', 'like', "%$string%")
                ->orWhereHas('curator', function ($query) use ($string) {
                    $query->where('first_name', 'like', "%$string%")
                        ->orWhere('last_name', 'like', "%$string%")
                        ->orWhere('surname', 'like', "%$string%");
                })
                ->orWhereHas('activityKind', function ($query) use ($string) {
                    $query->where('title', 'like', "%$string%")
                        ->orWhere('date', 'like', "%$string%");
                })
                ->orWhereHas('benchmark', function ($query) use ($string) {
                    $query->where('title', 'like', "%$string%");
                })
                ->orWhereHas('group', function ($query) use ($string) {
                    $query->where('title', 'like', "%$string%");
                })
                ->orWhereHas('indicator', function ($query) use ($string) {
                    $query->where('title', 'like', "%$string%")
                        ->orWhere('description', 'like', "%$string%");
                });
        }

        return $this;
    }
}
