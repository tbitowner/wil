<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Post extends Eloquent
{
    protected $guarded = ['ID'];

    protected $table = 'wp_posts';

    protected $key = 'ID';

    public function getKeyName()
    {
    	return $this->key;
    }

    public function meta()
    {
    	return $this->hasMany('PostMeta');
    }

    public function scopeAttachments($query)
    {
        return $query->where('post_type', '=', 'attachment');
    }

    public function asset()
    {
        return $this->hasOne('PostMeta', 'post_id')
        ->where('meta_key', '<>', '_edit_lock')
        ->where('meta_key', '<>', '_edit_last');
    }

    public function lastasset()
    {
        return $this->asset()
        ->where('meta_key', '<>', '_edit_last')
        ->orderBy('meta_id', 'desc');
    }
    
    /**
     *  @uses wp_term_relationships, wp_terms, wp_posts
     */
    public function terms()
    {
        return $this->belongsToMany('Term', 'wp_term_relationships', 'object_id', 'term_taxonomy_id');
    }
    
    public function scopePages($query)
    {
        return $query->where('post_type', '=', 'page')
                     ->where('post_status', '=', 'publish')
                     ->where('post_parent', '=', 0);
    }
    
    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use($search)
		{
            $query->where('post_name', '=', $search)
                ->where('post_status', '=', 'publish');
        });
    }
    
    public function childpages()
    {
        return $this->hasMany('Post', 'post_parent')
               ->where('post_type', '=', 'page')
               ->where('post_status', '<>', 'trash');
    }

    public function countChildPages()
    {
        return $this->childpages()->count();
    }
    
    public function hasChildPage()
    {
        return $this->countChildPages() > 0;
    }

    public function childassets()
    {
        return $this->hasMany('Post', 'post_parent')
               ->where('post_type', '=', 'attachment')
               ->where('post_mime_type', 'like', '%image%')
               ->where('post_status', '<>', 'trash');
    }

    public function countChildAssets()
    {
        return $this->childassets()->count();
    }

    public function hasChildAssets()
    {
        return $this->countChildAssets() > 0;
    }
}

class ChildPage extends Eloquent
{
    protected $guarded = ['id'];
    
    protected $table = 'wp_posts';
    
    protected $key = 'ID';

    public function getKeyName()
    {
    	return $this->key;
    }
}