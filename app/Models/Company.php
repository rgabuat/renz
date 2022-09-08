<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

Use App\Models\User;
Use App\Models\Package;
Use App\Models\Subscriptions;

class Company extends Model
{
    use HasFactory,Billable;

    protected $table = 'company';
    protected $fillable = [
        'company_name',
        'reg_number',
        'email',
        'created_by_owner',
        'created_by_admin',
        'status',
        'package_id',
        'started_at',
        'expires_at',
        'avail_credits',
        'city',
        'state',
        'country',
        'zip',
    ];

    public function admin_sub_accounts()
    {
        return $this->hasMany(User::class,'id','created_by_admin');
    }
    
    public function user_sub_accounts()
    {
        return $this->hasMany(User::class,'id','created_by_owner');
    }

    public function subscription()
    {
        return $this->hasMany(Subscriptions::class,'id','package_id');
    }

}
