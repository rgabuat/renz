<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

use App\Models\Company;
use App\Models\Article;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // public $timestamps = false;
    protected $table = 'users';
    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'email',
        'password',
        'is_activated',
        'username',
        'role'
    ];

    public function company()
    {
        return $this->hasMany(Company::class,'id','company_id');
    }

    public function created_by_owner()
    {
        return $this->hasMany(Company::class,'id','created_by_owner');
    }

    public function created_by_admin()
    {
        return $this->hasMany(Company::class,'id','created_by_admin');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
