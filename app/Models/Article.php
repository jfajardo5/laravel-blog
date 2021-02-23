<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'body',
    ];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }
}
