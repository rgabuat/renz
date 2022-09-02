<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;

    protected $table = 'tbl_invoices';
    protected $fillable = [
        'invoice_date_gen',
        'created_by',
    ];
}
