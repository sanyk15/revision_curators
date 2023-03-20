<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class ActivityKindFilter extends ModelFilter
{
    public function search(string $string): ActivityKindFilter
    {
        return $this->where('title', 'like', "%$string%");
    }
}
