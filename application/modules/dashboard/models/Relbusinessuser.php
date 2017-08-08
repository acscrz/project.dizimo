<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Relbusinessuser extends Zend_Db_Table {

    protected $_name = 'wo_rel_business_user';
    protected $_primary = 'id_rel_business_user';
    protected $_rowClass = 'Relbusinessuser';
    
    public function insertTable($data = null) {  
        return $this->insert($data);
    }
    
}
