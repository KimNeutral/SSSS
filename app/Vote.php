<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
    protected $fillable = [];

    public function article() {
    	return $this->belongsTo(Article::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
