<?php

class homeController extends TzController {
    public function indexAction () {

        if(TzAuth::isUserLoggedIn()){
            $userEntity = tzSQL::getEntity('users');
            $user = $userEntity->find($_SESSION['User']['id']);
        
            $this->tzRender->run('/templates/home', array('header' => "headers/homeHeader.html.twig",
                                                          'subMenu' => true,
                                                          'homeContext' => true,
                                                          'paramsAriane' => array()));
        }
        else{
            $this->tzRender->run('/templates/connect');
        }
    }


}
