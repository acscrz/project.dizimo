<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Zend_Db_Table {

    protected $_name = 'user';
    protected $_primary = 'id_user';
    protected $_rowClass = 'User';
    
    public function alterTable($id_user = null, $data = null) {        
        $where = $this->getAdapter()->quoteInto('id_user = ?', $id_user);        
        return $this->update($data, $where);         
    }
    
}
