<?php 

use Components\Auth\TzAuth;
use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;
use src\helpers\Guardian;

class roadmapController extends TzController {

    public function indexAction ($params) {

        $project_code = $params['project'];
        $project = Guardian::guardEntryProject($project_code);
        if (!$project)
            return(tzController::CallController("pageNotFound", "show"));

        $modalTicket = Guardian::guardModalTicket();

        $user = TzAuth::readUser();

        $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
            'nameProject' => $user['currentProject']->getProject_name(),
            'codeProject' => $user['currentProject']->getProject_code(),
            'category' => 'Roadmaps');

        $alert = Guardian::guardAlert();

        $this->tzRender->run('/templates/roadmap', array('header' => 'headers/roadmapHeader.html.twig',
            'modalTicket' => $modalTicket,
            'alert' => $alert,
            'currentPage' => 'roadmaps',
            'subMenuCurrent' => 'roadmaps',
            'paramsAriane' => $arianeParams));
    }

    public function detailAction ($params) {

        $project_name = $params['project'];

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
        $code = Guardian::guardUrl($params['name']);
        $roadmap->setRoadmap_code($code);
        $roadmap->setRoadmap_date_create(date('Y-m-d'));
        $roadmap->setRoadmap_date_update(date('Y-m-d'));
        $roadmap->setRoadmap_description($params['desc']);

        $roadmap->setProject_id($params['id']);

        $roadmap->Insert();

        return true;

    }
}
