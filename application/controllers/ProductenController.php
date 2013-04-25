<?php

class ProductenController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function clientAction()
    {
        $client     = new Zend_Soap_Client('http://192.168.33.95/producten/server?wsdl');
        // communiceert met de else uit serveraction
        $client->setSoapVersion(SOAP_1_1); // normaal is het 1.2, voor Zend 1.1
        $client->addProducts('titel', 'omschrijving', 15);
    }

    public function serverAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        // isset om =true op te vangen
        $wsdl = $this->getParam('wsdl');
        if(isset($wsdl)){
        // server opzetten
        // 
        // auto discover gaat van de class die we maakten een perfecte WSDL 
        // file maken gebaseerd op de application
        $server     = new Zend_Soap_AutoDiscover();
        
        // class meegeven aan de server
        $server->setClass('Application_Model_Producten');
        
        // gaat alles interpreteren en WSDL file creëren
        $server->handle();
        }else{
             $server = new Zend_Soap_Server();
             $server->setClass('Application_Model_Producten');
             $server->setObject(new Application_Model_Producten());
             $server->handle();
        }
    }
}