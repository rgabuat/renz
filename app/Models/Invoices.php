<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;

    protected $table = 'tbl_invoices';
    protected $fillable = [
        'inv_id',
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
        'created_at',
        'upated_at',
    ];
}
