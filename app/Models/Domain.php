<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $table = 'domain_data';
    protected $fillable = [
        'domain',
        'country' ,
        'domain_rating',
        'traffic',
        'ref_domain',
        'token_cost',
        'remarks',
    ];
  
}
