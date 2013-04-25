<?php

class Admin_Form_PostNews extends Zend_Form
{

    public function init()
    {
        $locale     = Zend_Registry::get('Zend_Locale');
        $url        = '/' .$locale .'/login';
        
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement(new Zend_Form_Element_Text('title', array(
            'label'     => 'title_lbl',
            'filters'   => array('stringTrim'),
            'required'  => true
        )));
        
        $this->addElement(new Zend_Form_Element_TextArea('text', array(
            'label'     => 'text_lbl',
            'filters'   => array('stringTrim'),
            'required'  => true
        )));
        
        $btn = new Zend_Form_Element_Button('versturen', array(
            'type'      => 'submit',
            'value'     => 'submit_lbl',
            'required'  => false,
            'ignore'    => true
        ));
        
        $this->addElement($btn);
    }


}