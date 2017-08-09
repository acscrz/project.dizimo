<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Offer extends Zend_Db_Table {

    protected $_name = 'wo_offer';
    protected $_primary = 'id_offer';
    protected $_rowClass = 'Offer';
    
    public function selectView($id_event = null) {
        $sql = $this->getAdapter()->select()->from('view_offer');
        
        if ($id_event != null) {
            $sql->where('id_event = ?', $id_event);
        }
        
        return $this->getAdapter()->fetchAll($sql);   
    } 
    
    public function selectViewDropdown() {
        $sql = $this->getAdapter()->select()->from('view_dropdown_type_offer');
        
        return $this->getAdapter()->fetchAll($sql);   
    } 
    
    public function insertTable($data = null) {            
        return $this->insert($data);         
    }
    
    public function updateTable($id_offer = null, $data = null) {        
        $where = $this->getAdapter()->quoteInto('id_offer = ?', $id_offer);        
        return $this->update($data, $where);         
    }
    
    public function deleteTable($id_offer = null) {        
        $where = $this->getAdapter()->quoteInto('id_offer = ?', $id_offer);        
        return $this->delete($where);         
    }
    
}
