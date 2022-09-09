<?php

namespace App\Models;

Use App\Models\User;
use App\Models\Domain;

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
        'status',
        'domain_id',
    ];

    public function created_by_company()
    {
        return $this->hasMany(User::class,'id','created_by');
    }

    public function domain()
    {
        return $this->hasOne(Domain::class,'id','domain_id');
    }
}
