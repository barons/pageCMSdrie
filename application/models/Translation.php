<?php

class Application_Model_Translation extends Zend_Db_Table_Abstract
{
    protected $_name = "translate";
    protected $_primary = "id";
    
    
    /**
     * get translations by locale
     * @param Zend_Locale $locale
     * @return Zend_Db_Table_Abstract $result
     */
    public function getTranslationByLocale(Zend_Locale $locale)
    {
        $select = $this->select()->where('locale = ?', $locale);
        $result = $this->fetchAll($select);
        return $result;
    }

}

