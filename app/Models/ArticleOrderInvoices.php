<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleOrderInvoices extends Model
{
    use HasFactory;

    protected $table = 'tbl_invoice_article';
    protected $fillable = [
        'art_ord_id',
        'inv_id',
    ];
}
