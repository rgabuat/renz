<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

Use App\Models\User;
Use App\Models\Package;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';
    protected $fillable = [
        'company_name',
        'reg_number',
        'created_by_owner',
        'created_by_admin',
        'status',
        'package_id',
        'started_at',
        'expires_at',
        'avail_credits',
    ];

    public function admin_sub_accounts()
    {
        return $this->hasMany(User::class,'id','created_by_admin');
    }
    
    public function user_sub_accounts()
    {
        return $this->hasMany(User::class,'id','created_by_owner');
    }

    public function package()
    {
        return $this->hasMany(Package::class,'id','package_id');
    }
}
