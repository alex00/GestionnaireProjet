<?php 

class roadmapController extends TzController {
    public function indexAction ($params) {

        $project_name = intval($params['project']);

        $arianeParams = array('idProject' => 1,
            'nameProject' => 'Project 1',
            'category' => 'Roadmaps');

        $this->tzRender->run('/templates/roadmap', array('header' => 'headers/roadmapHeader.html.twig',
                                                                     'subMenuCurrent' => 'roadmaps',
                                                                     'paramsAriane' => $arianeParams));
    }

    public function detailAction ($params) {

        $project_name = intval($params['project']);

        $arianeParams = array('idProject' => 1,
            'nameProject' => 'Project 1',
            'category' => 'roadmaps',
            'idDetail' => '1',
            'nameDetail' => $params['roadmap']);

        $roadmap = array('id' => 1, 'name' => 'Deuxieme version de truc', 'description' => 'desdsescecsecsecscesecsecsece cs cse cs ec ');

        $this->tzRender->run('/templates/detail', array('header' => 'headers/roadmapHeader.html.twig',
            'subMenuCurrent' => 'roadmaps',
            'entity' => $roadmap,
            'paramsAriane' => $arianeParams));
    }


    public function newRoadmapAction ($params) {

        $roadmap = tzSQL::getEntity('roadmaps');

        $roadmap->setRoadmap_title($params['name']);
        $code = trim(str_replace(" ","-",$params['name']));
        $roadmap->setRoadmap_code(strtolower(($code)));
        $roadmap->setRoadmap_date_create(date('Y-m-d'));
        $roadmap->setRoadmap_date_update(date('Y-m-d'));
        $roadmap->setRoadmap_description($params['desc']);

        $roadmap->setProject_id($params['id']);

        $roadmap->Insert();

    }
}
