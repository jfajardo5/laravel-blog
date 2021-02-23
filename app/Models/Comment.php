<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function article() 
    {
        return $this->belongsTo('App\Models\Article');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Comment', 'comment_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'comment_id', 'id'); 
    }
}
