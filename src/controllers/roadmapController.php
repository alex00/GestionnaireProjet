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
}
