<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class GroupFilter extends ModelFilter
{
    public function search(string $string): GroupFilter
    {
        return $this->where('title', 'like', "%$string%");
    }
}
