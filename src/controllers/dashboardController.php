<?php 

class dashboardController extends TzController {
	 public function indexAction ($params) {

		 $id_project = intval($params['id_project']);

         $arianeParams = array('idProject' => 1,
                                'nameProject' => 'Project 1',
                                'category' => 'Dashboard');

         $this->tzRender->run('/templates/dashboard', array('header' => 'headers/dashboardHeader.html.twig',
                                                            'subMenuCurrent' => 'dashboard',
                                                            'paramsAriane' => $arianeParams));
	}

}
