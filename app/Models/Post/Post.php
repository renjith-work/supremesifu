<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category()
	{
		return $this->belongsTo('App\Models\Post\PostCategory', 'category_id');
	}

	public function status()
	{
		return $this->belongsTo('App\Models\Post\PostStatus', 'status_id');
	}

	public function tags()
	{
		return $this->belongsToMany('App\Models\Post\PostTag', 'post_tag', 'post_id', 'tag_id');
	}

	public function user()
	{
	 return $this->belongsTo('App\User', 'user_id');
	}
}
