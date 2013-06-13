<?php 

class activityController extends TzController {
    public function indexAction ($params) {

        $id_project = intval($params['id_project']);

        $this->tzRender->run('/templates/activity', array('header' => 'headers/activityHeader.html.twig'));
    }
}
