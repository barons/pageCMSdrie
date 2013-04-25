<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
    protected function _initRegisterControllerPlugins()
    {
        $this->bootstrap('frontcontroller');
        $front = $this->getResource('frontcontroller');
        $front->registerPlugin(new Syntra_Controller_Plugin_Translate());
        $front->registerPlugin(new Syntra_Controller_Plugin_Navigation());
        // $front->registerPlugin(new Syntra_Auth_Acl());
        // $front->registerPlugin(new Syntra_Auth_Auth());
    }

    public function _initDbAdapter(){
        $this->bootstrap('db');
        $db = $this->getResource('db');
        // maak een soort van globale variabele
        Zend_Registry::set('db', $db);
    }
    
    /**
     * put after _initView
     * Create all custom routes
     * @param array $options
     * @return Zend_Controller_Router_Route
     */
    public function _initRouter (array $options = null)
    {
        $router = $this->getResource('frontcontroller')->getRouter();
        
        // custom routes aanmaken
        // : is met variabelen gaan werken = get variable
        // :lang = $_get['lang']
        
        // /:lang/-------/:slug
        // /nl_BE/pagina/titel
        // kan je opvragen met $this_getParam('lang');
        // of                                ('slug');
        // anders zou je moeten: /page/index/lang/nl_BE/slug/nieuws........
        $router->addRoute('lang',
                new Zend_Controller_Router_Route(':lang',array(
                    'controller' => 'index',
                    'action'     => 'index'
                )));
        
        $router->addRoute('login',
                new Zend_Controller_Router_Route(':lang/login',array(
                    'controller' => 'Users',
                    'action'     => 'login'
                )));
        
        $router->addRoute('logout',
                new Zend_Controller_Router_Route(':lang/logout',array(
                    'controller' => 'Users',
                    'action'     => 'logout'
                )));
        
        $router->addRoute('page',
                new Zend_Controller_Router_Route(':lang/pagina/:slug',array(
                    'controller' => 'page',
                    'action'     => 'index'
                )));
        
        $router->addRoute('admin',
                new Zend_Controller_Router_Route(':lang/admin/:controller/:action',array(
                    'module'     => 'admin',
                    'controller' => 'index',
                    'action'     => 'index'
                )));
        $router->addRoute('noaccess',
                new Zend_Controller_Router_Route('noaccess',array(
                    'controller' => 'noaccess',
                    'action'     => 'index'
                )));
        $router->addRoute('addnews',
                new Zend_Controller_Router_Route(':lang/admin/addnews',array(
                    'module'        => 'admin',
                    'controller'    => 'index',
                    'action'        => 'addNews'
                )));
        
    }
    
}

