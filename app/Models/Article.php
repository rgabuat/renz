<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'table_article';
    protected $fillable = [
        'title',
        'url',
        'body',
        'featured_image',
        'categories',
        'author',
        'created_by',
        'publishing_date',
    ];
}
