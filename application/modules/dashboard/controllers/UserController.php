<?php

class Dashboard_UserController extends Zend_Controller_Action {

    public function init() {
        if(!Zend_Auth::getInstance()->hasIdentity()){
            $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'sign', 'action' => 'in'));
        }
    }

    public function indexAction() {  
//        $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'information', 'action' => 'index'));
        $this->_helper->layout->setLayout('layout_default');
        $this->view->title = ' - Dizimistas';
        
        $this->view->headScript()
            ->appendFile($this->view->baseUrl('public/library/mask/js/library.mask.js'))
                
            ->appendFile($this->view->baseUrl('public/modules/dashboard/user/js/library.select.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/user/js/library.insert.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/user/js/library.update.js'))
//            ->appendFile($this->view->baseUrl('public/modules/dashboard/user/js/library.delete.js'))
                ;
    }
    
    public function ajaxAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        
        Zend_Loader::loadClass("User");
        $model = new User();
        
        $array = $model->selectView();
        
        foreach ($array as $value) {
            $result[] = array(
                $value['id_user'],
                $value['cpf'],
                $value['username'],
                $value['date_birth']
            );
        }  
        
        echo Zend_Json::encode(array(data => ($result == null ? [] : $result)));
    }
    
    public function dropdownAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        
        Zend_Loader::loadClass("User");
        $model = new User();
        
        $array = $model->selectViewDropdown($this->_request->getParam("q"));
        
        foreach ($array as $value) {
            $result[] = array(
                name => $value['username'],
                value => $value['id_user'],
                text => $value['username'],
                disabled => false
            );
        }  
        
        echo Zend_Json::encode(array(success => true, results => ($result == null ? [] : $result)));
    }
    
    public function insertAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    
        Zend_Loader::loadClass("User");
        $model = new User();
        
        $data = array(
            cpf => $this->_request->getParam('cpf'),
            username => $this->_request->getParam('username'),
            date_birth => $this->_request->getParam('date_birth'),
            email => $this->_request->getParam('email'),
            mobile => $this->_request->getParam('mobile')
        );
        
        $result = $model->insertTable($data);
        
        echo Zend_Json::encode($result);    
    }
    
    public function updateAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    
        Zend_Loader::loadClass("User");
        $model = new User();
        
        Zend_Loader::loadClass("Relbusinessuser");
        $rel = new Relbusinessuser();
        
        $result = $model->updateTable($this->_request->getParam('id_user'), array(password => md5($this->_request->getParam('password1'))));
        
        $rel->insertTable(array(id_business => Zend_Auth::getInstance()->getIdentity()->id_business, id_user => $this->_request->getParam('id_user')));
        
        echo Zend_Json::encode($result);    
    }
    
}
