<?php
use Components\Auth\TzAuth;
use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;

class homeController extends TzController {
    public function indexAction () {

        if(TzAuth::isUserLoggedIn()){
        
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
