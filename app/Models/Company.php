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
    use HasFactory;

    protected $table = 'company';
    protected $fillable = [
        'company_name',
        'reg_number',
        'created_by_owner',
        'created_by_admin',
        'status',
    ];
    
}
