<?php
// src/Acme/TaskBundle/Entity/Task.php
namespace TBIT\FormBundle\Entity;

class Creator
{
    public function create(\TBIT\FormRepository\FormBuilderRepositoryInterface $builder, \Silex\Application $app)
    {
        return $builder->buildForm($app);
    }
}