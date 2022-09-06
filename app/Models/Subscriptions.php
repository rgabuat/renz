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
        'inv_stripe_id',
        'customer' ,
        'amount_due',
        'billing_reason',
        'collection_method',
        'created',
        'due_date',
        'currency',
        'hosted_invoice_url',
        'invoice_pdf',
        'number',
        'status',
        'inv_id',
        'created_at',
        'upated_at',
        'company_id',
    ];

}

