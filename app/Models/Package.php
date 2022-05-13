<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'tbl_package';
    protected $fillable = [
        'name',
        'price' ,
        'description',
        'credits',
        'payment_method',
        'duration',
        'created_by',
    ];
}
