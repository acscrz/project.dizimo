<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Oncall extends Zend_Db_Table {

    protected $_name = 'oncall';
    protected $_primary = 'id_oncall';
    protected $_rowClass = 'Oncall';
    
    public function selectView($id_business = null) {
        $sql = $this->getAdapter()->select()->from('view_oncall');
        
        if ($id_business != null) {
            $sql->where('id_business = ?', $id_business);
        }
        
        return $this->getAdapter()->fetchAll($sql);   
    } 
    
    public function alterTable($id_user = null, $data = null) {        
        $where = $this->getAdapter()->quoteInto('id_user = ?', $id_user);        
        return $this->update($data, $where);         
    }
    
}
