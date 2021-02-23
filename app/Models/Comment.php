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

    /**
     * Get comment author.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get parent article.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article() 
    {
        return $this->belongsTo('App\Models\Article');
    }

    /**
     * Get parent comment.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Comment', 'comment_id', 'id');
    }

    /**
     * Get child comments.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'comment_id', 'id'); 
    }
}
