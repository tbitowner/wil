<?php

namespace TBIT\FormRepository;

use VisualFormBuilderForm;

/**
 * Integration of VisualFormBuilder with Silex
 * @package wordpress visual form builder
 * @author Matthew Muro
 */
class VisualFormBuilder implements FormBuilderRepositoryInterface
{
    public function buildForm($app)
    {
        $visualformfields = VisualFormBuilderForm::find(1)->fields()->get();
        
        $form = $app['form.factory']->createBuilder('form');
        
        foreach($visualformfields as $field)
        {
            if($field->field_type == 'select')
            {
                $field->field_type = 'choice';
            }
            
            $form = $form->add($field->field_name, $field->field_type, array('label' => $field->field_name, 'attr' => array('class' => $field->field_css, 'placeholder' => $field->field_description)) );
        }
        
        // return silex formbuilder instance
        return $form->getForm();
    }
}