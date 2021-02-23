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
        'comment',
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function article() 
    {
        return $this->belongsTo('App\Models\Article');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'parent_id', 'id'); 
    }
}
