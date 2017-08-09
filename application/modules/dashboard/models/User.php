<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Zend_Db_Table {

    protected $_name = 'wo_user';
    protected $_primary = 'id_user';
    protected $_rowClass = 'User';
    
    public function selectView($id_business = null) {
        $sql = $this->getAdapter()->select()->from('view_user');
        
        if ($id_business != null) {
            $sql->where('id_business = ?', $id_business);
        }
        
        return $this->getAdapter()->fetchAll($sql);   
    } 
    
    public function selectViewDropdown($search = null) {
        $sql = $this->getAdapter()->select()->from('view_dropdown_user');
        
        if ($search != null) {
            $sql->where('username like ?', '%' . $search . '%');
        }
        
        $sql->limit(5);
        
        return $this->getAdapter()->fetchAll($sql);   
    } 
    
    public function insertTable($data = null) {  
        return $this->insert($data);
    }
    
    public function updateTable($id_user = null, $data = null) {        
        $where[] = $this->getAdapter()->quoteInto('id_user = ?', $id_user);    
        return $this->update($data, $where);         
    }
    
    public function deleteTable($id_user = null) {        
        $where = $this->getAdapter()->quoteInto('id_user = ?', $id_user);        
        return $this->delete($where);         
    }
    
}
