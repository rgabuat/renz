<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UserCollection implements WithStartRow
{
     /**
     * @return int
     */
    public function startRow(): int
    {
        return 1;
    }
    
}
