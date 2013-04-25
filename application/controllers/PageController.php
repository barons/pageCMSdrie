<?php

class PageController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $locale = Zend_Registry::get('Zend_Locale');
        // of $lang = $this->_getParam('lang');
        $slug = $this->_getParam('slug');
        
        $pageModel = new Application_Model_Page();
        $page = $pageModel->getPage($locale, $slug);
        // hier wordt page gedefinieerd, kan je dan gebruiken in je view
        $this->view->page = $page;
    }


}

