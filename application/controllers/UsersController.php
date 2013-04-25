<?php

class UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        $loginForm = new Application_Form_Login();
        $this->view->form = $loginForm;
        
        // login procedure
        // controle of er geklikt is op knop
        if ($this->getRequest()->getPost()){
            $postParams = $this->getRequest()->getPost();
            
            if($this->view->form->isValid($postParams)){
                
                $params = $this->view->form->getValues();
                
                // authenticatie definiëren
                $auth = Zend_Auth::getInstance();
                
                // meegeven welke database driver we gebruiken
                // moeten we geen select * blablabla doen
                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('db'));
                            //welke table gebruiken
                $authAdapter->setTableName('users')
                            // welke kolom gebruiken
                            ->setIdentityColumn('username')
                            // welke kolom voor paswoord
                            ->setCredentialColumn('password')
                            // komen via definitie van params uit login.php
                            ->setIdentity($params['login'])
                            ->setCredential($params['password']);
                
                // authenticatie aanroepen en in var steken
                // login uitvoeren
                $result = $auth->authenticate($authAdapter);
                var_dump($result);
                
                if($result->isValid()){
                    // ingelogd
                    echo 'u bent ingelogd';
                }else{
                    // niet ingelogd
                    // de foutmeldingen weergeven op het scherm
                    foreach($result->getMessages() as $message){
                        echo $message;
                    }
                }
                
            }
        }
    }

    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        die ('u bent uitgelogged');
    }


}





