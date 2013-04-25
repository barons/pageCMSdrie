<?php

class Syntra_Controller_Plugin_Navigation extends Zend_Controller_Plugin_Abstract
{
    
    public function preDispatch(\Zend_Controller_Request_Abstract $request) 
    {
        /* definieren van caching */
        
        // twee elementen, frontend en backend
        // frontend, hoelang
        
        $frontendOptions = array(
            'lifetime'                  => 3600, // 1 uur in de cache
            'automatic_serialization'   => true
        );
        
        // realpath zal het volledige pad gaan ophalen
        // volledige root tot aan de public/html
        // zorgt ervoor dat het op ieder systeem werkt
        // cache folder zal op ons systeem in de root staan
        
        $backendOptions = array(
            'cache_dir' => APPLICATION_PATH.'/../cache'
        );
        
        // object aanmaken
        
        $cache = Zend_Cache::factory('Core',
                                     'File',
                                     $frontendOptions,
                                     $backendOptions
                );
        
        // key meegeven (meerdere caches mogelijk)
        // bvb navigation
        // gaat cache gaan inladen, zit er nog geen in zal het fals genereren
        // 'je zoekt een file met naam navigation'
        // als bestaat zal hij het inladen
        // kunnen we dus perfect in een if steken, als opgevult lezen, anders maken
        // dmv ronde haken eerst opvullen en dan vergelijken
        // als false is hij leeg, bevat hij inhoud is hij vol
        
        if(($result = $cache->load('navigation')) === false){
            // onze cache bestaat niet
            
            $locale = Zend_Registry::get('Zend_Locale');
            $model = new Application_Model_Page();
            $pages = $model->getMenu($locale);
        
            $container = new Zend_Navigation();
        
            foreach ($pages as $page)
                {
                     $menu = new Zend_Navigation_Page_Mvc(
                        array(
                        'label' => $page['title'], 
                        //'controller' => 'index',
                        'route'  => 'page',
                        'params' => array('slug' => $page['slug'],
                                'lang' => $locale)
                ));
            
                $container->addPage($menu);
                }
                // cache object wegschrijven
            $cache->save($container,'navigation');
        }else{
            $container = $result;
            // echo 'we zitten in de cache !';
        }
        
        Zend_Registry::set('Zend_Navigation', $container);
    }
    
}

?>
