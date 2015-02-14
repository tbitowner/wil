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

    public function usermeta()
    {
    	return $this->hasMany('UserMeta', 'user_id');
    }

    public function firstname()
    {
    	return $this->usermeta()->where('meta_key', '=', 'first_name')->first()->meta_value;
    }

    public function lastname()
    {
    	return $this->usermeta()->where('meta_key', '=', 'last_name')->first()->meta_value;
    }

    public function fullname()
    {
    	return $this->firstname() . ' ' . $this->lastname();
    }
}

class UserMeta extends Eloquent
{
	protected $fillable = ['user_id', 'meta_key', 'meta_value'];

	protected $table = 'wp_usermeta';

	protected $key = 'umeta_id';

	public function getKeyName()
	{
		return $this->key;
	}
}