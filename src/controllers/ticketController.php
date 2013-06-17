<?php 

class ticketController extends TzController {
	 public function indexAction ($params) {

         $id_project = intval($params['id_project']);

         $arianeParams = array('idProject' => 1,
             'nameProject' => 'Project 1',
             'category' => 'tickets');

         $this->tzRender->run('/templates/ticket', array('header' => 'headers/ticketHeader.html.twig',
                                                                     'subMenuCurrent' => 'tickets',
                                                                     'paramsAriane' => $arianeParams));
	}

    public function detailAction ($params) {

        $id_project = intval($params['id_project']);

        $arianeParams = array('idProject' => 1,
            'nameProject' => 'Project 1',
            'category' => 'tickets',
            'idDetail' => '1',
            'nameDetail' => $params['name_ticket']);

        $ticket = array('id' => 1, 'name' => 'Deuxieme version de truc', 'description' => 'desdsescecsecsecscesecsecsece cs cse cs ec ');

        $this->tzRender->run('/templates/detail', array('header' => 'headers/ticketHeader.html.twig',
            'subMenuCurrent' => 'tickets',
            'entity' => $ticket,
            'paramsAriane' => $arianeParams));
    }
}
