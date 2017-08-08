<?php

class Dashboard_EventController extends Zend_Controller_Action {

    public function init() {
        if(!Zend_Auth::getInstance()->hasIdentity()){
            $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'sign', 'action' => 'in'));
        }
    }

    public function indexAction() {  
//        $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'information', 'action' => 'index'));
        $this->_helper->layout->setLayout('layout_default');
        $this->view->title = ' - Plantões';
        
        $this->view->headScript()
            ->appendFile($this->view->baseUrl('public/modules/dashboard/event/js/library.select.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/event/js/library.insert.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/event/js/library.alter.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/event/js/library.delete.js'));
    }
    
    public function detailsAction() {  
//        $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'information', 'action' => 'index'));
        $this->_helper->layout->setLayout('layout_default');
        $this->view->title = ' - Plantões';
        
        $this->view->headScript()
            ->appendFile($this->view->baseUrl('public/modules/dashboard/event/js/library.select.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/event/js/library.insert.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/event/js/library.alter.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/event/js/library.delete.js'));
    }
    
    public function ajaxAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        
        Zend_Loader::loadClass("Event");
        $model = new Event();
        
        $array = $model->selectView(Zend_Auth::getInstance()->getIdentity()->id_business);
        
        foreach ($array as $value) {
            $result[] = array(
                $value['id_event'],
                $value['datetime_event'],
                $value['status_event']
            );
        }  
        
        echo Zend_Json::encode(array(data => ($result == null ? [] : $result)));
    }
    
    public function insertAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    
        Zend_Loader::loadClass("Event");
        $model = new Event();
        
        $data = array(
            datetime_event => $this->_request->getParam('date_event') . ' ' . $this->_request->getParam('time_event'),
            id_business => Zend_Auth::getInstance()->getIdentity()->id_business
        );
        
        $result = $model->insertTable($data);
        
        echo Zend_Json::encode($result);    
    }
    
    public function updateAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    
        Zend_Loader::loadClass("Event");
        $model = new Event();
        
        $data = array(
            observation => $this->_request->getParam('observation'),
            status_event => 1
        );
        
        $result = $model->updateTable(Zend_Auth::getInstance()->getIdentity()->id_event, $data);
        
        echo Zend_Json::encode($result);    
    }
    
}
