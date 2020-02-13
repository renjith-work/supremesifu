<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    public function posts()
    {
    	return $this->belongsToMany('App\Models\Post\Post', 'post_tag', 'tag_id', 'post_id');
    }
}
