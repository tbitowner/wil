<?php

namespace TBIT\Libraries;
use Illuminate\Support\Collection;

class FormCreator
{
    protected $forms;
    
    CONST FORM_OPEN = '<form ';
    CONST FORM_OPEN_END = '>';
    CONST FORM_CLOSE = '</form>';
    CONST FORM_ACTION = 'action=';
    CONST FORM_METHOD = 'method=';
    CONST FORM_ID = 'id=';
    CONST FORM_CLASS = 'class=';
    CONST FORM_ROLE = 'role=';
    
    public function __construct(Collection $forms)
    {
        $this->forms = $forms;
    }
    
    public function renderForm()
    {
        $theForm = '';
        
        foreach( $this->forms as $form )
        {
            $theForm .= self::FORM_OPEN . self::FORM_METHOD . "$form->method" . self::FORM_ACTION . "/contact" . self::FORM_OPEN_END;
            
            foreach( $form->fields()->get() as $fields )
            {
                $theForm .= $this->createField($fields);
            }
        }
    }
    
    public function performFormAction(Collection $forms)
    {
        // how to know which action to perform
    }
    
    private function createField($field)
    {
        
    }
}
    
    