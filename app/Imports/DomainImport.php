<?php

namespace App\Imports;

use App\Models\Domain;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;


class DomainImport implements ToModel,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        return new Domain([
            'domain' => $row['domain'],
            'country' => $row['country'],
            'domain_rating' => $row['domain_rating'],
            'traffic' => $row['traffic'],
            'ref_domain' => $row['ref_domain'],
            'token_cost' => $row['token_cost'],
            'remarks' => $row['remarks'],
            'last_updated' => $row['last_updated'],
        ]);
    }
}
