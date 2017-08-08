<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $this->_helper->layout->setLayout('layout_application');
        $this->view->title = ' em construção';
        
        $this->view->headLink()
                ->appendStylesheet($this->view->baseUrl('public/modules/application/css/style.default.css'))
                ->appendStylesheet($this->view->baseUrl('public/modules/application/css/style.index.css'));
        
        $this->view->headScript()
                ->appendFile($this->view->baseUrl('public/modules/application/js/jquery.default.js'));
    }
    
}
