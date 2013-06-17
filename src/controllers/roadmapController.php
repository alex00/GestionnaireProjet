<?php 

class roadmapController extends TzController {
    public function indexAction ($params) {

        $id_project = intval($params['id_project']);

        $arianeParams = array('idProject' => 1,
            'nameProject' => 'Project 1',
            'category' => 'Roadmaps');

        $this->tzRender->run('/templates/roadmap', array('header' => 'headers/roadmapHeader.html.twig',
                                                                     'subMenuCurrent' => 'roadmaps',
                                                                     'paramsAriane' => $arianeParams));
    }

    public function detailAction ($params) {

        $id_project = intval($params['id_project']);

        $arianeParams = array('idProject' => 1,
            'nameProject' => 'Project 1',
            'category' => 'roadmaps',
            'idDetail' => '1',
            'nameDetail' => $params['name_roadmap']);

        $roadmap = array('id' => 1, 'name' => 'Deuxieme version de truc', 'description' => 'desdsescecsecsecscesecsecsece cs cse cs ec ');

        $this->tzRender->run('/templates/detail', array('header' => 'headers/roadmapHeader.html.twig',
            'subMenuCurrent' => 'roadmaps',
            'entity' => $roadmap,
            'paramsAriane' => $arianeParams));
    }
}
