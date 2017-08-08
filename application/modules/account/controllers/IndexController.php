<?php

class Account_IndexController extends Zend_Controller_Action {

    public function init() {
        if(!Zend_Auth::getInstance()->hasIdentity()){
            $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'sign', 'action' => 'in'));
        }
    }

    public function indexAction() {  
        $this->_helper->redirector->gotoRoute(array('module' => 'dashboard', 'controller' => 'event', 'action' => 'index'));
        $this->_helper->layout->setLayout('layout_default');
        $this->view->title = ' - Página inicial';
        
    }
    
}
