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
         $infosHeader['nb_members_project'] = $user_serviceEntity->countMembersProjectNew($project_code);
         
         
//         $userEntity = tzSQL::getEntity('users');
//         $listUser = $userEntity->allMembersProject($user["currentProject"]->getProject_id());
//        
//         $tabUser = array();
//         
//         foreach ($listUser as $value) {
//             array_push($tabUser, $value['user_login_code']);
//         }
         
         // Liste user modal
         $tabUser = Guardian::guardTabMembersAdd($user["currentProject"]->getProject_id());


         $notifs = Guardian::guardGetNotifs();

         $projectEntity = tzSQL::getEntity('projects');
         $statDash = $projectEntity->getInfosProject($user['currentProject']->getProject_id());

         $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
                                'nameProject' => $user['currentProject']->getProject_name(),
                                'codeProject' => $user['currentProject']->getProject_code(),
                                'categoryName' => 'Dashboard');

         $alert = Guardian::guardAlert();

         $noifs = tzSQl::getEntity('notifications');
         $notifs_center = $noifs->getNotificationsByProject($user['currentProject']->getProject_id());


         $user_serviceEntity = tzSQL::getEntity('user_service');
         $list_project_affiliated = $user_serviceEntity->listProjectAffiliated($user['id']);
         $list_project_created = $user_serviceEntity->listProjectCreated($user['id']);
         $projectAll = array_merge($list_project_created, $list_project_affiliated);

         $this->tzRender->run('/templates/dashboard', array('header' => 'headers/dashboardHeader.html.twig',
                                                            'modalTicket' => $modalTicket,
                                                            'alert' => $alert,
                                                            'notif_center' => $notifs_center,
                                                            'notifs' => $notifs,
                                                            'currentPage' => 'dashboard',
                                                            'projectAll' => $projectAll,
                                                            'statDash' => $statDash,
                                                            'infosHeader' => $infosHeader,
                                                            'subMenuCurrent' => 'dashboard',
                                                            'tabUsers' => $tabUser,
                                                            'paramsAriane' => $arianeParams));


	}

}
