<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class CompanyUsers extends Model
{
    use HasFactory;

    protected $guard_name = 'web';
    protected $table = 'company_users';
    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'username',
        'email',
        'password',
        'role',
        'is_activated',
    ];
}
