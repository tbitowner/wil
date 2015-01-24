<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Term extends Eloquent
{
	protected $guarded = ['term_id'];

	protected $table = 'wp_terms';

	protected $key = 'term_id';

	public function getKeyName()
	{
		return $this->key;
	}
    
    /**
     *  @uses wp_term_relationships, wp_terms, wp_posts
     */
	public function posts()
	{
		return $this->belongsToMany('Post', 'wp_term_relationships', 'term_taxonomy_id', 'object_id');
	}
}