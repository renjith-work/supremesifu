<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    public function parent()
	{
	    return $this->belongsTo(PostCategory::class, 'parent_id');
	}

	public function children()
	{
	    return $this->hasMany(PostCategory::class, 'parent_id');
	}

	public function posts()
	{
		return $this->hasMany('App\Models\Post\Post', 'category_id');
	}
}
