<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostStatus extends Model
{
	public function posts()
	{
		return $this->hasMany('App\Models\Post\Post', 'status_id');
	}
}
