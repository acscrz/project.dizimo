<?php

class Account_TutorialController extends Zend_Controller_Action {

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_helper->redirector->gotoRoute(array('module'=> 'account', 'controller'=> 'sign', 'action' =>'in'));
        }
    }
    
    public function ajaxAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        
        Zend_Loader::loadClass("Tutorial");
        $model = new Tutorial();
        
        $array = $model->selectView(Zend_Auth::getInstance()->getIdentity()->id_user, $this->_request->getParam('pathname'));
        
        foreach ($array as $value) {
            $result[] = array(
                intro => ($value['intro']),
                element => ($value['element']),
                position => ($value['position'])
            );
        }  
        
        echo Zend_Json::encode($result);
    }
    
    public function insertAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
    
        Zend_Loader::loadClass("Tutorial");
        $model = new Tutorial();
        
        $result = $model->insertTable(Zend_Auth::getInstance()->getIdentity()->id_user, $this->_request->getParam('pathname'));
        echo Zend_Json::encode($result);    
    }
    
}