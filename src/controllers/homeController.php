<?php 

class homeController extends TzController {
	 public function indexAction () {
        if(TzAuth::isUserLoggedIn()){
            $this->tzRender->run('/templates/home', array('header' => "headers/homeHeader.html.twig"));
        }
        else{
             $this->tzRender->run('/templates/connect');
        }
     }
}
