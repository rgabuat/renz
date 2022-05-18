<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;

    protected $table = 'tbl_subscriptions';
    protected $fillable = [
        'user_id',
        'started_at' ,
        'expires_at',
        'avail_credits',
        'package_id',
        'status',
    ];
}

