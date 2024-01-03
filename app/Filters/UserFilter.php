<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    public function search(string $string): UserFilter
    {
        return $this->where('first_name', 'like', "%$string%")
            ->orWhere('last_name', 'like', "%$string%")
            ->orWhere('surname', 'like', "%$string%");
    }
}
