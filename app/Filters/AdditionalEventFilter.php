<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class AdditionalEventFilter extends ModelFilter
{
    public function search(string $string): AdditionalEventFilter
    {
        return $this->where('title', 'like', "%$string%");
    }
}
