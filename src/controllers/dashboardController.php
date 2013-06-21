<?php 

class dashboardController extends TzController {

    private function getModalTickets(){
        $linkUser = tzSQL::getEntity('user_service');
        $user = TzAuth::readUser();

        $userByService = $linkUser->findManyBy('project_id', $user['currentProjectId']);

        $result = array();
        foreach ($userByService as $users){

            $usersEntity = tzSQL::getEntity('users');
            $serviceEntity = tzSQL::getEntity('services');

            $usersEntity->findOneBy('id',$users->getUser_id());
            $serviceEntity->findOneBy('service_id',$users->getService_id());

            if (!isset($result['services'][$users->getService_id()]['name']))
                $result['services'][$users->getService_id()]['name'] = $serviceEntity->getService_name();

            $result['services'][$users->getService_id()]['members'][$users->getUser_id()]['id'] = $users->getUser_id();
            $result['services'][$users->getService_id()]['members'][$users->getUser_id()]['login'] = $usersEntity->getUser_login();

        }

        $roadmaps = tzSQL::getEntity('roadmaps');

        $allRoadmaps = $roadmaps->findManyBy('project_id',1);
        if ($allRoadmaps){
            foreach ($allRoadmaps as $road){
                $result['roadmaps'][$road->getRoadmap_id()]['id'] = $road->getRoadmap_id();
                $result['roadmaps'][$road->getRoadmap_id()]['title'] = $road->getRoadmap_title();
            }
        }

        return $result;
    }
	 public function indexAction ($params) {

		 $project_code = $params['project'];

         $project = Guardian::guardEntry($project_code);

         if (!$project)
            return(tzController::CallController("pageNotFound", "show"));

         $modalTicket = $this->getModalTickets();

         $user = TzAuth::readUser();

         $arianeParams = array('idProject' => $user['currentProjectId'],
                                'nameProject' => $user['currentProjectName'],
                                 'codeProject' => $user['currentProjectCode'],
                                'category' => 'Dashboard');

         $this->tzRender->run('/templates/dashboard', array('header' => 'headers/dashboardHeader.html.twig',
                                                            'modalTicket' => $modalTicket,
                                                            'currentProjectId' => $project->getProject_id(),
                                                             'currentProjectCode' => $project->getProject_code(),
                                                             'currentProjectName' => $project->getProject_name(),
                                                            'subMenuCurrent' => 'dashboard',
                                                            'paramsAriane' => $arianeParams));
	}

}
