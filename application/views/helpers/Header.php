<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Zend_View_Helper_Header extends Zend_View_Helper_Abstract {
    
    public function header() {
        return  '<div class="ui very padded vertical basic segment">
                    <div class="ui width equal grid container">
                        <div class="column">
                            <div class="ui text inverted menu">
                                <div class="item">
                                    <h2 class="ui inverted header title-agency">
                                        Weone
                                        <div class="sub header">Marketing digital</div>
                                    </h2>
                                </div>
                                <div class="computer only right item">
                                    <a class="item" href="' . $this->view->baseUrl('/'). '">Página inicial</a>
                                    <a class="item item-popup">Serviços</a>
                                    <a class="item" href="http://blog.weone.com.br/">Blog</a>
                                    <a class="item" href="javascript:jivo_api.open();">Contato</a>
                                    <div class="item"><a class="ui button" href="' . $this->view->baseUrl('account/sign/in'). '">Entrar</a></div>
                                </div>
                            </div>
                            <div class="ui flowing inverted popup">
                                <div class="ui center aligned column grid">
                                    <div class="column">
                                        <div class="ui list">
                                            <a class="item" href="' . $this->view->baseUrl('services/wehost') . '">Hospedagem</a>
                                            <a class="item" href="' . $this->view->baseUrl('services/wesite') . '">Criação de sites</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
    }
    
}
