<?php 

class roadmapController extends TzController {
    public function indexAction ($params) {

        $id_project = intval($params['id_project']);

        $this->tzRender->run('/templates/roadmap', array('header' => 'headers/roadmapHeader.html.twig'));
    }
}
