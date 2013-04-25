<?php

/**
 * Webservice for SOAP
 * 
 * @author Samuel Houwen <samuel@baronsdesign.be> 
 */

class Application_Model_Producten
{
    /**
     * Add product
     * @param string $titel
     * @param string $omschrijving
     * @param float $prijs
     * @return object $product;
     */
    public function addProducts($titel, $omschrijving, $prijs)         
    {
        $product        = stdClass();
        return $product;
    }
    
    
    /**
     * Delete the product by id
     * @param integer $id
     * @return boolean
     */
    public function delProducts($id)
    {
        return true;
    }
    
    /**
     * 
     * @param integer $id
     * @param string $titel
     * @param string $omschrijving
     * @param float $prijs
     */
    public function modProducts($id, $titel, $omschrijving, $prijs)
    {
        $product        = stdClass();
        return $product;
    }

}

