<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

Use App\Models\User;
Use App\Models\Company;
class ArticleOrder extends Model
{
    use HasFactory;

    protected $table = 'tbl_article_order';
    protected $fillable = [
        'user_id',
        'company_id',
        'type',
        'offer',
        'url',
        'publishing_date',
        'accepted_at',
        'completed_at',
        'status',
    ];

    public function company()
    {
        return $this->hasMany(Company::class,'id','company_id');
    }

    public function user()
    {
        return $this->hasMany(User::class,'id','user_id');
    }
}
