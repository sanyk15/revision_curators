<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class IndicatorFilter extends ModelFilter
{
    public function search(string $string): IndicatorFilter
    {
        return $this->where('title', 'like', "%$string%")
            ->orWhere('description', 'like', "%$string%");
    }
}
