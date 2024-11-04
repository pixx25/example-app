<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Comment
 * Represents a comment associated with a specific post and user.
 */
class Comment extends Model{
    //enables factory methods for comment model
    use HasFactory;

    protected $table = 'comments';

    /**
     * Define a relationship to the User model.
     * Indicates that each Comment "belongs to" a specific User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(related: User::class);
    }

    /**
     * Define a relationship to the Post model.
     * Indicates that each Comment "belongs to" a specific Post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo(related: Post::class);
    }
}