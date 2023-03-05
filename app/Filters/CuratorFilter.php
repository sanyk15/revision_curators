<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class CuratorFilter extends ModelFilter
{
    public function search(string $string): CuratorFilter
    {
        return $this->where('first_name', 'like', "%$string%")
            ->orWhere('last_name', 'like', "%$string%")
            ->orWhere('surname', 'like', "%$string%");
    }
}
