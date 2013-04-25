<?php
// ACL = Acces Control List
class Syntra_Auth_Acl extends Zend_Controller_Plugin_Abstract 
{
    public function preDispatch(\Zend_Controller_Request_Abstract $request) 
    {
        // ACL definieren
        $acl    = new Zend_Acl();
        // roles definieren
        $roles  = array('GUEST','USER','ADMIN');
        // controllers definieren
        $controllers = array('Users','index','page','error','noaccess','admin:index','admin:add-news');
        
        // rollen toevoegen aan de ACL
        foreach($roles as $role)
        {
            $acl->addRole($role);
        }
        
        // controllers toevoegen
        foreach ($controllers as $controller)
        {
            // $acl->addResource($controller);
            $acl->add(new Zend_ACL_Resource($controller));
        }
        
        // rollen toekennen
        $acl->allow('ADMIN'); // tot alles toegang, niets gedefinieerd
        $acl->deny('USER'); // standaard geen toegang
        // Daarna toegang geven aan wat moet
        $acl->allow('USER','page'); // user geen toegang tot de admin index
        $acl->allow('USER','index'); // user geen toegang tot de admin index
        $acl->allow('USER','Users'); // user geen toegang tot de admin index
        $acl->allow('USER','noaccess'); // user geen toegang tot de admin index
        
        Zend_Registry::set('Zend_Acl', $acl);
    }
}

?>
