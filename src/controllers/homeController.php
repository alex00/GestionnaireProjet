<?php 

class homeController extends TzController {
	 public function connectAction () {
         $this->tzRender->run('/templates/home', array('header' => "headers/homeHeader.html.twig",
                                                       'subMenu' => true));
	}
}
