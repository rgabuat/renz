<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\PlanModel;
use App\Models\SubscriptionsRequests;
class SubscriptionsRequests extends Model
{
    use HasFactory;

    protected $table = 'tbl_subscription_requests';
    protected $fillable = [
        'cus_uid',
        'cus_sid',
        'plan_id',
        'status',
    ];

    public function user()
    {
        return $this->hasMany(User::class,'id','cus_uid');
    }

    public function plan()
    {
        return $this->hasMany(PlanModel::class,'id','plan_id');
    }

}
