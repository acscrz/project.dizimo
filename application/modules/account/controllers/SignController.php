<?php

class Account_SignController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function inAction() {
        if(Zend_Auth::getInstance()->hasIdentity()){
            $this->_helper->redirector->gotoRoute(array('module' => 'account', 'controller' => 'index', 'action' => 'index'));
        }
        $this->_helper->layout->setLayout('layout_blank');
        $this->view->title = ' em construção';
        
        $this->view->headLink();
                   
        $this->view->headScript()
                ->appendFile($this->view->baseUrl('public/modules/account/js/sign/library.sign.in.js'));
        
    }
    
    public function loggingAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $email = $this->_request->getParam("mail");
        $password = $this->_request->getParam("password");
        echo Zend_Json::encode($this->process($email, $password));    
    }

    protected function process($username, $password) {
        $adapter = $this->getAuthAdapter();
        $adapter->setIdentity($username);
        $adapter->setCredential($password);
        $adapter->setCredentialTreatment('MD5(?)');


        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $adapter->getResultRowObject();
            $auth->getStorage()->write($user);
            return true;
        } else {
            return false;
        }
    }

    protected function getAuthAdapter() {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

        $authAdapter->setTableName('view_loggin');
        $authAdapter->setIdentityColumn('email');
        $authAdapter->setCredentialColumn('password');

        return $authAdapter;
    }

    public function outAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index', 'index');
    }
    
}