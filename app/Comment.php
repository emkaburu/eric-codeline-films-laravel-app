<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'comments';

    protected $fillable = [
        'user_id', 'film_id', 'user_name', 'comment'
    ];

    //Relationships
     /**
     * Get the user that owns the Comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A Comment can belong to only one Film
     */

     public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }
}
