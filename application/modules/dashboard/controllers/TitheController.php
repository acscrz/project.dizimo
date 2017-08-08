<?php

class Dashboard_TitheController extends Zend_Controller_Action {

    public function init() {
        if(!Zend_Auth::getInstance()->hasIdentity()){
            $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'sign', 'action' => 'in'));
        }
    }

    public function indexAction() {  
//        $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'information', 'action' => 'index'));
        $this->_helper->layout->setLayout('layout_default');
        $this->view->title = ' - Plantão';
        
        $this->view->headScript()
            ->appendFile($this->view->baseUrl('public/modules/dashboard/tithe/js/library.select.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/tithe/js/library.insert.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/tithe/js/library.update.js'))
//            ->appendFile($this->view->baseUrl('public/modules/dashboard/tithe/js/library.delete.js'))
                
            ->appendFile($this->view->baseUrl('public/modules/dashboard/offer/js/library.select.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/offer/js/library.insert.js'))
                ;
        
        Zend_Loader::loadClass("Event");
        $model = new Event();
        
        $value = $model->selectView(Zend_Auth::getInstance()->getIdentity()->id_business, $this->_request->getParam("q"));
        
        Zend_Auth::getInstance()->getIdentity()->id_event = $value[0]['id_event'];
        Zend_Auth::getInstance()->getIdentity()->datetime_event = $value[0]['datetime_event'];
        Zend_Auth::getInstance()->getIdentity()->status_event = $value[0]['status_event'];
        Zend_Auth::getInstance()->getIdentity()->observation = $value[0]['observation'];
    }
    
    public function ajaxAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        
        Zend_Loader::loadClass("Tithe");
        $model = new Tithe();
        
        $array = $model->selectView($this->_request->getParam("id_event"));
        
        foreach ($array as $value) {
            $result[] = array(
                $value['id_tithe'],
                $value['cpf'],
                $value['username'],
                $value['datetime_record']
            );
        }  
        
        echo Zend_Json::encode(array(data => ($result == null ? [] : $result)));
    }
    
    public function insertAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    
        Zend_Loader::loadClass("Tithe");
        $model = new Tithe();
        
        $data = array(
            id_user => $this->_request->getParam('id_user'),
            id_event => $this->_request->getParam('id_event')
        );
        
        $result = $model->insertTable($data);
        
        echo Zend_Json::encode($result);    
    }
    
}
