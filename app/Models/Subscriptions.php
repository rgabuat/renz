<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Package;

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
        'company_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class,'id','user_id');
    }

    public function package()
    {
        return $this->hasMany(Package::class,'id','package_id');
    }
}

