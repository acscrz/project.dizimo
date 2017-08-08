<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Event extends Zend_Db_Table {

    protected $_name = 'wo_event';
    protected $_primary = 'id_event';
    protected $_rowClass = 'Event';
    
    public function selectView($id_business = null, $id_event = null) {
        $sql = $this->getAdapter()->select()->from('view_event');
        
        if ($id_business != null) {
            $sql->where('id_business = ?', $id_business);
        }
        
        if ($id_event != null) {
            $sql->where('id_event = ?', $id_event);
        }
        
        return $this->getAdapter()->fetchAll($sql);   
    } 
    
    public function insertTable($data = null) {              
        return $this->insert($data);         
    }
    
    public function updateTable($id_event = null, $data = null) {        
        $where = $this->getAdapter()->quoteInto('id_event = ?', $id_event);        
        return $this->update($data, $where);         
    }
    
}
