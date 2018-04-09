<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['title', 'content', 'thumbImage', 'desc', 'category_id', 'articlecategory_id'];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function votes() {
    	return $this->hasMany(Vote::class);
    }

    public function comments() {
    	return $this->hasMany(Comment::class);
    }
}
