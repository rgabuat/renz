<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Package extends Model
{
    use HasFactory,Billable;

    protected $table = 'tbl_package';
    protected $fillable = [
        'name',
        'price' ,
        'description',
        'credits',
        'payment_method',
        'duration',
        'created_by',
    ];

    public function user()
    {
        return $this->hasMany(User::class,'id','created_by');
    }
    
}
