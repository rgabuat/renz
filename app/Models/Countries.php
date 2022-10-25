<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $table = 'tbl_countries';
    protected $fillable = [
        'country_code',
        'country_name',
        'created_at',
        'updated_at'
    ];

}
