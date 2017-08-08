<?php

class Dashboard_OfferController extends Zend_Controller_Action {

    public function init() {
        if(!Zend_Auth::getInstance()->hasIdentity()){
            $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'sign', 'action' => 'in'));
        }
    }

    public function ajaxAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        
        Zend_Loader::loadClass("Offer");
        $model = new Offer();
        
        $array = $model->selectView(Zend_Auth::getInstance()->getIdentity()->id_event);
        
        foreach ($array as $value) {
            $result[] = array(
                $value['id_offer'],
                $value['value_offer'],
                $value['name_type_offer']
            );
        }  
        
        echo Zend_Json::encode(array(data => ($result == null ? [] : $result)));
    }
    
    public function dropdownAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        
        Zend_Loader::loadClass("Offer");
        $model = new Offer();
        
        $array = $model->selectViewDropdown($this->_request->getParam("q"));
        
        foreach ($array as $value) {
            $result[] = array(
                name => $value['name_type_offer'],
                value => $value['id_type_offer'],
                text => $value['name_type_offer'],
                disabled => false
            );
        }  
        
        echo Zend_Json::encode(array(success => true, results => ($result == null ? [] : $result)));
    }
    
    public function insertAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    
        Zend_Loader::loadClass("Offer");
        $model = new Offer();
        
        $data = array(
            value_offer => $this->_request->getParam('value_offer'),
            id_type_offer => $this->_request->getParam('id_type_offer'),
            id_event => Zend_Auth::getInstance()->getIdentity()->id_event
        );
        
        $result = $model->insertTable($data);
        
        echo Zend_Json::encode($result);    
    }
    
}
