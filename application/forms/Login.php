<?php

class Application_Form_Login extends Zend_Form
{
    public function init()
    {
        $locale     = Zend_Registry::get('Zend_Locale');
        $url        = '/' .$locale .'/login';
        
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        // LOGIN
        
        $this->addElement(new Zend_Form_Element_Text('login', array(
            'label'     => 'login_lbl',
            'filters'   => array('stringTrim'),
            'required'  => true
        )));
        
        // password
        
        $this->addElement(new Zend_Form_Element_Text('password', array(
            'label'     => 'password_lbl',
            'filters'   => array('stringTrim'),
            'required'  => true
        )));
        
        $btn = new Zend_Form_Element_Button('submit', array(
            'type'      => 'submit',
            'value'     => 'submit_lbl',
            'required'  => false,
            'ignore'    => true
        ));
        
        $this->addElement($btn);
        
    }
}

?>
