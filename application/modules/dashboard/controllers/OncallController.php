<?php

class Dashboard_OncallController extends Zend_Controller_Action {

    public function init() {
        if(!Zend_Auth::getInstance()->hasIdentity()){
            $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'sign', 'action' => 'in'));
        }
    }

    public function indexAction() {  
//        $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'information', 'action' => 'index'));
        $this->_helper->layout->setLayout('layout_default');
        $this->view->title = ' - Plantonistas';
        
        $this->view->headScript()
            ->appendFile($this->view->baseUrl('public/library/mask/js/library.mask.js'))
                
            ->appendFile($this->view->baseUrl('public/modules/dashboard/oncall/js/library.select.js'))
            ->appendFile($this->view->baseUrl('public/modules/dashboard/oncall/js/library.update.js'))
//            ->appendFile($this->view->baseUrl('public/modules/dashboard/oncall/js/library.alter.js'))
//            ->appendFile($this->view->baseUrl('public/modules/dashboard/oncall/js/library.delete.js'));
                ;
                
    }
    
    public function ajaxAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        
        Zend_Loader::loadClass("Oncall");
        $model = new Oncall();
        
        $array = $model->selectView(Zend_Auth::getInstance()->getIdentity()->id_business);
        
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
    
    public function removeAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    
        Zend_Loader::loadClass("Relbusinessuser");
        $model = new Relbusinessuser();
        
        $result = $model->updateTable($this->_request->getParam('id_user'), Zend_Auth::getInstance()->getIdentity()->id_business, array(level => 0));

        echo Zend_Json::encode($result);    
    }
    
    public function deleteAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');

        Zend_Loader::loadClass("Oncall");
        $model = new Oncall();

        $result = $model->deleteTable($this->_request->getParam("id_user"));

        echo Zend_Json::encode($result);
    }
    
}
