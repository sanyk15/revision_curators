<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class BenchmarkFilter extends ModelFilter
{
    public function search(string $string): BenchmarkFilter
    {
        return $this->where('title', 'like', "%$string%");
    }
}
