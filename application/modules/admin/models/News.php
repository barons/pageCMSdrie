<?php

class Admin_Model_News extends Zend_Db_Table_Abstract
{
    protected $_name    = 'news';
    protected $_primary = 'id';
    
    public function getAllNews()
    {
        // Zend_Db_Select
        /*$db = Zend_registry::get('db');
        $select = $db->select();
        $select->from('nieuws');
        $select->where(// search criteria'')
        $select->order(// search criteria'')*/
        
        $this->fetchAll(); // select * FROM nieuws, komt door ingebouwde functionaliteit
    }
    
    public function addNews($params)
    {     
        
        $this->insert($params);
        //// insert into nieuws velden, values,..........
        // params is een array, dus key title met waarde, key id met waarde....
        // Dus -> 
        // $params = array('titel' => 'lipsum', 'omschrijving' => 'blabla');
        
    }
    
    public function modNews($params, $id)
    {     
        // beveiligd de variabele dmv de adapter
        // zorgen dat hetgeen je erin steekt 'veilig' is
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->update($params, $where);
        //// insert into nieuws velden, values,..........
        // params is een array, dus key title met waarde, key id met waarde....
        // Dus -> 
        // $params = array('titel' => 'lipsum', 'omschrijving' => 'blabla');
        
    }
    
    public function deleteNews($id)
    {     
        // beveiligd de variabele dmv de adapter
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->delete($where);
        //// insert into nieuws velden, values,..........
        // params is een array, dus key title met waarde, key id met waarde....
        // Dus -> 
        // $params = array('titel' => 'lipsum', 'omschrijving' => 'blabla');
        
    }
}

