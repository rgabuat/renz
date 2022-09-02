<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionsInvoices extends Model
{
    use HasFactory;

    protected $table = 'tbl_invoice_subscriptions';
    protected $fillable = [
        'subs_ord_id',
        'inv_id',
    ];
}
