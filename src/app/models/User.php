<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $guarded = ['ID'];

    protected $table = 'wp_users';

    protected $key = 'ID';

    public function getKeyName()
    {
    	return $this->key;
    }
}