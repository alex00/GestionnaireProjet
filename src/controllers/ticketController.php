<?php 

class ticketController extends TzController {
	 public function indexAction ($params) {

         $id_project = intval($params['id_project']);

         $arianeParams = array('idProject' => 1,
             'nameProject' => 'Project 1',
             'category' => 'Tickets');

         $this->tzRender->run('/templates/ticket', array('header' => 'headers/ticketHeader.html.twig',
                                                                     'subMenuCurrent' => 'tickets',
                                                                     'paramsAriane' => $arianeParams));
	}
}
