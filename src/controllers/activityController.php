<?php 

class activityController extends TzController {
    public function indexAction ($params) {
        $project_name = intval($params['project']);


        $arianeParams = array('idProject' => 1,
            'nameProject' => 'Project 1',
            'category' => 'Activity');

        $this->tzRender->run('/templates/activity', array('header' => 'headers/activityHeader.html.twig',
                                                                        'subMenuCurrent' => 'activity',
                                                                        'paramsAriane' => $arianeParams));
    }

    public function detailAction ($params) {

        $project_name = intval($params['project']);

        $arianeParams = array('idProject' => 1,
            'nameProject' => 'Project 1',
            'category' => 'activity',
            'idDetail' => '1',
            'nameDetail' => $params['announce']);

        $this->tzRender->run('/templates/detail', array('header' => 'headers/activityHeader.html.twig',
            'subMenuCurrent' => 'activity',
            'paramsAriane' => $arianeParams));
    }
}
