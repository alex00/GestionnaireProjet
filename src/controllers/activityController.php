<?php 

class activityController extends TzController {
    public function indexAction ($params) {

        $id_project = intval($params['id_project']);


        $arianeParams = array('idProject' => 1,
            'nameProject' => 'Project 1',
            'category' => 'Activity');

        $this->tzRender->run('/templates/activity', array('header' => 'headers/activityHeader.html.twig',
                                                                        'subMenuCurrent' => 'activity',
                                                                        'paramsAriane' => $arianeParams));
    }
}
