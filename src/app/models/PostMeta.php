<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class PostMeta extends Eloquent
{
	protected $guarded = ['meta_id'];

	protected $table = 'wp_postmeta';

	protected $key = 'meta_id';

	public function getKeyName()
	{
		return $this->key;
	}

	public function post()
	{
		return $this->belongsTo('Post');
	}

	public function scopeSearch($query, $search)
	{
		return $query->where(function($query) use($search)
		{
            $query->where('meta_value', '=', $search)
                ->where('meta_key', '=', '_wp_attached_file');
        });
	}
}