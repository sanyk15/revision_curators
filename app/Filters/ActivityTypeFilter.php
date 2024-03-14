<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class ActivityTypeFilter extends ModelFilter
{
    public function search(string $string): ActivityTypeFilter
    {
        return $this->where('title', 'like', "%$string%");
    }
}
