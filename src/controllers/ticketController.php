<?php 

class ticketController extends TzController {
	 public function indexAction ($params) {

         $id_project = intval($params['id_project']);

         $this->tzRender->run('/templates/ticket', array('header' => 'headers/ticketHeader.html.twig'));
	}
}
