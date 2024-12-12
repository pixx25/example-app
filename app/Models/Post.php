<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Post
 * Represents a blog post model with relationships to User and Comment models
 */
class Post extends Model{
    //enables factory methods for post model
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];
    
    /**
     * Define a relationship to the User model.
     * Indicates that each Post "belongs to" a specific User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(related: User::class);
    }

    /**
     * Define a relationship to the Comment model.
     * Indicates that each Post "has many" related comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
        return $this->hasMany(related: Comment::class);
    }
}
