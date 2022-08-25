<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

use App\Models\Users;

class PlanModel extends Model
{
    use HasFactory,Billable;

    protected $table = 'tbl_plans';
    protected $fillable = [
        'plan_id',
        'name',
        'amount' ,
        'billing_method',
        'interval_count',
        'price',
        'currency',
        'description',
        'credits',
        'payment_method',
        'created_by',
    ];

    public function user()
    {
        return $this->hasMany(User::class,'id','created_by');
    }

}
