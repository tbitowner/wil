<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Option extends Eloquent
{

    public $timestamps = false;

	protected $guarded = ['option_id'];

	protected $table = 'wp_options';

	protected $key = 'option_id';

	public function getKeyName()
	{
        return $this->key;
	}
    
    public function scopeTitle($query)
    {
        return $query->select('option_value')
               ->where('option_name', '=', 'blogname');
    }
}