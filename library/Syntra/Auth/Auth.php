<?php

class Syntra_Auth_Auth extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(\Zend_Controller_Request_Abstract $request){
        
        // Voor alles uitgevoerd wordt bepaalde zaken controleren.
        $loginController = 'Users';
        $loginAction     = 'Login';
        $local           = Zend_Registry::get('Zend_Locale');
        // Singleton, kan maar één maal aangeroept worden
        $auth            = Zend_Auth::getInstance();
        
        // !auth als hij identity heeft dwz ingelogged
        // if user is not logged in and is not requesting the login page
        // -redirect to login page
        if(!$auth->hasIdentity()
                && $request->getControllerName() != $loginController
                && $request->getActionName()     != $loginAction){
                    
            $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
            $redirector->gotoUrl('/nl_BE/login');
        }
        
        if ($auth->hasIdentity()){
            // die('Hello user!');
            // systeem bewaren
            $registry       = Zend_Registry::getInstance();
            // acl ophalen defined in acl
            $acl            = $registry->get('Zend_Acl');
            // Username gaan ophalen en wegschrijvin in identity
            $identity       = $auth->getIdentity();
            
            // rol dynamisch gaan ophalen
            $usersModel     = new Application_Model_Users();
            $user           = $usersModel->getUserByIdentity($identity);
            
            Zend_Registry::set('user', $user);
            $role           = $user->role;
            
            if($request->getModuleName() !== 'default' && $request->getModuleName() !== NULL){
                $isAllowed = $acl->isAllowed($role,
                        $request->getModuleName().':'.
                        $request->getControllerName(),
                        $request->getActionName());
                
            }else{
                $isAllowed = $acl->isAllowed($role,
                        $request->getControllerName(),
                        $request->getActionName());
            }
            
            if(!$isAllowed){
                $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
                $redirector->gotoUrl('/noaccess');
            }
        }
    }
}

?>
