<?php 

class dashboardController extends TzController {
	 public function indexAction ($params) {

		 $id_project = intval($params['id_project']);

         $this->tzRender->run('/templates/dashboard', array('header' => 'headers/dashboardHeader.html.twig'));
	}

}
