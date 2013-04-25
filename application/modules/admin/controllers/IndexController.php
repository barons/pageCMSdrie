<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        // die ('ik zit in de indexaction van admin');
    }

    public function addNewsAction()
    {
        die('ik zit in de admin module');
        $PostNewsForm = new Admin_Form_PostNews();
        $this->view->form = $PostNewsForm;
        
        // zorgen dat nieuws in de database raakt
        if ($this->getRequest()->isPost()){
            $postParams = $this->getRequest()->getPost();
            
            // controle, als alles correct is
            if ($this->view->form->isValid($postParams)){
                
                // die ('geklikt en ingevuld');
                unset($postParams['versturen']); // we schrijven de knop niet weg....
                $nieuwsModel = new Admin_Model_News();
                $nieuwsModel->addNews($postParams);
                
                // $this->_redirect('/nieuws1/overzicht');
                // vervangen door functies van Zend dus ->
                // die ('toegevoegd');
                // $this->_redirect($this->view->url(array('controller' => 'Nieuws1', 'action' => 'overzicht')));
                
                $nieuws = $this->getAllNews();
                $this->view->news = $nieuws;
            }
        }
    }

    public function removeNewsAction()
    {
        // action body
    }

    public function listNewsAction()
    {
        $nieuws = $this->getAllNews();
        
        $this->view->news = $nieuws;
    }

    public function modNewsAction()
    {
        $id     = $this->_getParam('id'); 
        // $_GET['id'];
        /*$sql    = "select * from nieuws where id = " .$id;
        $result = $this->db->query($sql);
        $nieuws = $result->fetch(); // haal alles altijd op
        */
        
        $newsModel = new Application_Model_News();
        // current, je hebt er maar 1 nodig, al de rest van code weg
        // anders moet je een foreach doen
        $news     = $newsModel->find($id)->current(); // SELECT * FROM nieuws WHERE id = $id
        
        $form        = new Application_Form_News();
        // populate, juiste veldjes opvullen met data die je wilt
        $form->populate($news>toArray()); // omzetten in array om het formulier op te vullen
        
        // populate form
        
        /*$form->getElement('titel')->setValue($nieuws['titel']);
        $form->getElement('omschrijving')->setValue($nieuws['omschrijving']);*/
        
        $this->view->form = $form;
        
        // zorgen dat nieuws in de database raakt
        if ($this->getRequest()->isPost()){
            $postParams = $this->getRequest()->getPost();
            
            // controle, als alles correct is
            if ($this->view->form->isValid($postParams)){
                
                unset($postParams['versturen']);
                
                $newsModel->modNews($postParams, $id);
                $this->_redirect('/news/overzicht');
                
            }
            
        }
    }


}









