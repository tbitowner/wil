<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class FormBuilderFields extends Eloquent
{
    protected $guarded = ['id'];
    
    protected $table = 'wp_formbuilder_fields';
    
    public function form()
    {
        return $this->belongsTo('FormBuilderForms', 'form_id');
    }
}

class FormBuilderForms extends Eloquent
{
    protected $guarded = ['id'];
    
    protected $table = 'wp_formbuilder_forms';
    
    public function fields()
    {
        return $this->hasMany('FormBuilderFields', 'form_id');
    }
    
    public function response()
    {
        return $this->hasOne('FormBuilderResponses', 'autoresponse');
    }
}

class FormBuilderPages extends Eloquent
{
    
}

class FormBuilderResponses extends Eloquent
{
    protected $guarded = ['id'];
    
    protected $table = 'wp_formbuilder_responses';
}

class FormBuilderResults extends Eloquent
{
    
}

class FormBuilderTags extends Eloquent
{
    
}