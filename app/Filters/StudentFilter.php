<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class StudentFilter extends ModelFilter
{
    public function search(string $string): StudentFilter
    {
        return $this->where('first_name', 'like', "%$string%")
            ->orWhere('last_name', 'like', "%$string%")
            ->orWhere('surname', 'like', "%$string%")
            ->orWhere('phone', 'like', "%$string%")
            ->orWhere('email', 'like', "%$string%");
    }

    public function group(int $groupId): StudentFilter
    {
        return $this->where('group_id', '=', $groupId);
    }
}
