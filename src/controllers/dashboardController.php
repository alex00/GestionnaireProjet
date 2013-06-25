<?php 
use Components\Auth\TzAuth;
use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;
use src\helpers\Guardian;

class dashboardController extends TzController {

	 public function indexAction ($params) {

		 $project_code = $params['project'];
         $project = Guardian::guardEntryProject($project_code);
         if (!$project)
            return(tzController::CallController("pageNotFound", "show"));
         $modalTicket = Guardian::guardModalTicket();

         $user = TzAuth::readUser();
         $infosHeader = array();

         $user_serviceEntity = tzSQL::getEntity('user_service');
         $infosHeader['creator'] = $user_serviceEntity->findCreatedProjects($user["currentProject"]->getProject_id());
         $infosHeader['nb_members'] = $user_serviceEntity->countMembersProject($user["id"]);

         $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
                                'nameProject' => $user['currentProject']->getProject_name(),
                                'codeProject' => $user['currentProject']->getProject_code(),
                                'category' => 'Dashboard');

         $alert = Guardian::guardAlert();

         $this->tzRender->run('/templates/dashboard', array('header' => 'headers/dashboardHeader.html.twig',
                                                            'modalTicket' => $modalTicket,
                                                            'alert' => $alert,
                                                            'currentPage' => 'dashboard',
                                                            'infosHeader' => $infosHeader,
                                                            'subMenuCurrent' => 'dashboard',
                                                            'paramsAriane' => $arianeParams));


	}

}
