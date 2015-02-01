<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class VisualFormBuilderForm extends Eloquent
{
    protected $guarded = ['form_id'];
    
    protected $table = 'wp_visual_form_builder_forms';
    
    public function getKeyName()
    {
        return 'form_id';
    }
    
    public function fields()
    {
        return $this->hasMany('VisualFormBuilderField', 'form_id')
               ->where('field_type', '<>', 'verification')
               ->where('field_type', '<>', 'secret')
               ->where('field_type', '<>', 'submit')
               ->where('field_type', '<>', 'fieldset')
               ->orderBy('field_sequence', 'asc');
    }
    
    public function scopeContact($query)
    {
        return $query->where('form_key', '=', 'contact');
    }
}

class VisualFormBuilderField extends Eloquent
{
    protected $guarded = ['field_id'];
    
    protected $table = 'wp_visual_form_builder_fields';
    
    public function getKeyName()
    {
        return 'field_id';
    }
    
    public function form()
    {
        return $this->belongsTo('VisualFormBuilderForm', 'form_id');
    }
}

class VisualFormBuilderEntry extends Eloquent
{
    
}