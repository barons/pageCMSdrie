<?php

class Application_Model_Page extends Zend_Db_Table_Abstract
{
    protected $_name = "page";
    protected $_primary = "id";
    
    const MENU_VISIBLE = 1;
    const MENU_INVISIBLE = 0;
    
    const STATUS_ONLINE = 1;
    const STATUS_OFFLINE = 0;
    
    public function getMenu($locale)
    {
        $select = $this->select()
                ->where('menu = ?', self::MENU_VISIBLE)
                ->where('status = ?', self::STATUS_ONLINE)
                ->where('locale = ?', $locale);
        $result = $this->fetchAll($select);
        return $result;
    }
    
    /**
     * get the page by locale and slug
     * @param Zend_Locale $locale
     * @param string $slug
     * @return Zend_Db_Table_Rowset
     */
    public function getPage($locale, $slug = null)
    {
        if ($slug === null){
            return;
        }
        $select = $this->select()
                ->where('status = ?', self::STATUS_ONLINE)
                ->where('locale = ?', $locale)
                ->where('slug = ?', $slug);
        $result = $this->fetchAll($select)->current();
        return $result;
    }
    
    
}


