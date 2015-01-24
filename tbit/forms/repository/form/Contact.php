<?php
// src/Acme/TaskBundle/Entity/Task.php
namespace TBIT\FormRepository;

use VisualFormBuilderForm;

class Contact
{
    protected $listener;
    
    protected $app;
    
    protected $request;
    
    protected $contactform;
    
    public function __construct($listener, $app, $request)
    {
        $this->listener = $listener;
        
        $this->app = $app;
        
        $this->request = $request;
        
        $this->contactform = VisualFormBuilderForm::contact()->first();
    }
    
    public function post($form)
    {
        $form->handleRequest($this->request);

        if ($form->isValid()) 
        {
            $data = $form->getData();
            //dd( $this->formEmailTo() );
            // the message that goes to darol
            $message = \Swift_Message::newInstance()
            ->setSubject($this->formEmailSubject())
            ->setFrom(array($data['Email']))
            ->setTo(array($this->formEmailTo()))
            ->setBody($data['Message']);

            $this->app['mailer']->send($message);
            
            // the message that goes to the poster
            $message = \Swift_Message::newInstance()
            ->setSubject($this->formNotificationSubject())
            ->setFrom(array($this->formNotificationEmailFrom()))
            ->setTo(array($data['Email']))
            ->setBody($this->formNotificationMessage());

            $this->app['mailer']->send($message);
            
            
        }
        // redirect somewhere
        return $this->listener->contactAction($this->app, $this->request);
    }
    
    public function formEmailTo()
    {       
       if( isset($this->contactform))
       {
           return $this->stripWordPressCharacters($this->contactform->form_email_to);
       }
       
       return 'Darol@techbaseit.com';
    }
    
    private function stripWordPressCharacters($emailto)
    {
        $var = ltrim( end(explode(':', $emailto)), '"');
        
        return ( str_replace('";}', '', $var) );
    }
    
    public function formEmailFrom()
    {
        return $this->contactform->form_email_from;
    }
    
    public function formEmailSubject()
    {
        return $this->contactform->form_email_subject;
    }
    
    public function formEmailFromName()
    {
        return $this->contactform->form_email_from_name;
    }
    
    public function formNotificationSubject()
    {
        return $this->contactform->form_notification_subject;
    }
    
    public function formNotificationMessage()
    {
        return html_entity_decode($this->contactform->form_notification_message);
    }
    
    public function formNotificationEmailFrom()
    {
        return $this->contactform->form_notification_email_from;
    }
}