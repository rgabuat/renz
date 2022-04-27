<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Company extends Model
{
    use HasFactory,HasRoles;

    protected $guard_name = 'web';
    protected $table = 'company';
    protected $fillable = [
        'company',
        'first_name',
        'last_name',
        'address',
        'reg_number',
        'phone_number',
        'email',
        'password',
        'username',
        'role'
    ];
}
