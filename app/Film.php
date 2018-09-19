<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
	protected $table = 'films';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'realease_date', 'rating', 'ticket_price', 'country', 'genre_id', 'photo_url', 'slug'
    ];

    //Relationships
    /**
     * A Film can have many Comments ... Get all the Comments for this Film
     */
    public function comments() {
        return $this->hasMany(Comment::class, 'film_id');
    }

    //Many many relationship ... A film can belong to several genres and a genre can have many films
    //belongstomany? What of the inverse?
}
