<?php


class Syntra_Controller_Plugin_Translate extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $lang = $request->getParam('lang');
        if (empty($lang)){
            $lang = 'nl_BE';
        }else{
            $lang =$request->getParam('lang');
        }
        
        // zorgt ervoor dat zend weet in welke locale hij zit
        $locale = new Zend_Locale($lang);
        
        // maak beschikbaar voor alle Zend Componenten onder de naam Zend_Locale
        Zend_Registry::set('Zend_Locale', $locale);
        
        // we maken een array 'array' en stoppen er al eentje in 'yese => 'ja'
        $translate = new Zend_Translate('array', array('yes' => 'ja'), $locale);
        
        $model = new Application_Model_Translation();
        // select ster from locale where ....
        // haal alle vertalingen op voor de huidige locale
        $translations = $model->getTranslationByLocale($locale);
        
        // alle vertalingen toevoegen aan het translate object
        foreach ($translations as $translation)
        {
            // vertaling maken (t) en toevoegen aan locale
            $t = array($translation->tag => $translation->translation);
            // array translate gaan opvullen met vertaling
            $translate->addTranslation($t, $locale);
        }
        
        // maak beschikbaar voor alle Zend Componenten, ook voor Zend
        Zend_Registry::set('Zend_Translate', $translate);
        
    }
}

?>
