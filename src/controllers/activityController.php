<?php 
use Components\Auth\TzAuth;
use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;
use Components\FileManager\TzFileManager;
use src\helpers\Guardian;

class activityController extends TzController {


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
            'categoryName' => 'Activity');

        $alert = Guardian::guardAlert();
        $user_serviceEntity = tzSQL::getEntity('user_service');
        $list_project_affiliated = $user_serviceEntity->listProjectAffiliated($user['id']);
        $list_project_created = $user_serviceEntity->listProjectCreated($user['id']);
        $projectAll = array_merge($list_project_created, $list_project_affiliated);

        // Liste user modal
         $tabUser = Guardian::guardTabMembersAdd($user["currentProject"]->getProject_id());
        
        $this->tzRender->run('/templates/activity', array('header' => 'headers/activityHeader.html.twig',
            'modalTicket' => $modalTicket,
            'alert' => $alert,
            'projectAll' => $projectAll,
            'currentPage' => 'activity',
            'subMenuCurrent' => 'activity',
            'tabUsers' => $tabUser,
            'paramsAriane' => $arianeParams));
    }
    

    public function announceDetailAction ($params) {

        $project_code = $params['project'];
        $announce_code = $params['announce'];

        $project = Guardian::guardEntryProject($project_code);
        if (!$project)
            return(tzController::CallController("pageNotFound", "show"));

        $modalTicket = Guardian::guardModalTicket();
        $alert = Guardian::guardAlert();

        $user = TzAuth::readUser();

        $announces = TzSQL::getEntity('announces');

        $allAnnounces = $announces->findManyBy('announce_code', $announce_code);

        if ($allAnnounces){
            foreach ($allAnnounces as $announce){
                if ($announce->getProject_id() == $user['currentProject']->getProject_id()){

                    $detailAnnounce = $announce;
                }
            }
        }
        $user_serviceEntity = tzSQL::getEntity('user_service');
        $list_project_affiliated = $user_serviceEntity->listProjectAffiliated($user['id']);
        $list_project_created = $user_serviceEntity->listProjectCreated($user['id']);
        $projectAll = array_merge($list_project_created, $list_project_affiliated);

        $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
            'nameProject' => $user['currentProject']->getProject_name(),
            'codeProject' => $user['currentProject']->getProject_code(),
            'categoryName' => 'announces',
            'detailContext' => true,
            'currentPage' => 'announce',
            'detailCode' => $detailAnnounce->getAnnounce_code(),
            'categoryLink' => 'organization',
            'nameDetail' => $detailAnnounce->getAnnounce_title());

        // Liste user modal
         $tabUser = Guardian::guardTabMembersAdd($user["currentProject"]->getProject_id());

        $this->tzRender->run('/templates/detailAnnounce', array('header' => 'headers/roadmapHeader.html.twig',
            'subMenuCurrent' => 'organization',
            'entity' => $detailAnnounce,
            'projectAll' => $projectAll,
            'alert' => $alert,
            'modalTicket' => $modalTicket,
            'tabUser' => $tabUser,
            'paramsAriane' => $arianeParams));
    }


    public function newProjectAction ($params) {

        $project = tzSQL::getEntity('projects');

        $project->setProject_name($params['name']);
        $project->setProject_description($params['desc']);
        $project->setProject_date_create(date('Y-m-d'));
        $project->setProject_date_update(date('Y-m-d'));
        $code = Guardian::guardUrl($params['name']);
        $project->setProject_code($code);

        $project->Insert();


        $service = tzSQL::getEntity('services');

        $service->setService_name('Not affiliated');
        $service->setService_code('not-affiliated');
        $service->setProject_id($project->getProject_id());

        $service->Insert();




        $linkService = tzSQL::getEntity('user_service');
        $user = TzAuth::readUser();

        $linkService->setUser_id($user['id']);
        $linkService->setService_id($service->getService_id());
        $linkService->setProject_id($project->getProject_id());
        $linkService->setRightKey(1);

        $linkService->Insert();

        //$params = array('project_id' => $project->getProject_id());
        //Guardian::guardAddNotif('newProject',$params);

        return true;
    }



    public function newAnnounceAction ($params) {

        $announce = tzSQL::getEntity('announces');

        $announce->setAnnounce_title($params['name']);
        $code = Guardian::guardUrl($params['name']);
        $announce->setAnnounce_code($code);
        $announce->setAnnounce_date_create(date('Y-m-d'));
        $announce->setAnnounce_date_update(date('Y-m-d'));
        $announce->setAnnounce_description($params['desc']);

        $announce->setProject_id($params['id']);

        $announce->setCreator_id($_SESSION['User']['id']);

        $announce->Insert();

        $user = $_SESSION['User'];
        //$user_dest = tzSQL::getEntity('user_service');
        //$userByService = $user_dest->findManyBy('project_id', $params['id']);
        //var_dump($userByService);

        $paramsNotif = array('announce_id' => $announce->getAnnounce_id(),
                             'user_creator_id' => $user['id'],
                             'project_id' => $params['id']);

        Guardian::guardAddNotif('newAnnounce', $paramsNotif);

        TzAuth::addUserSession(array('alert' => 'announce'));

        return true;
    }


    public function newMemberAction ($params) {
        
        $logins = array();
        
        $params['login1'] != 'null' ? array_push($logins, $params['login1']) : false;
        $params['login2'] != 'null' ? array_push($logins, $params['login2']) : false;
        $params['login3'] != 'null' ? array_push($logins, $params['login3']) : false;
        $params['login4'] != 'null' ? array_push($logins, $params['login4']) : false;
        $params['login5'] != 'null' ? array_push($logins, $params['login5']) : false;


        $logins = array_unique($logins);
        
        foreach($logins as $login){

            $projectsEntity = tzSQL::getEntity('projects');
            $serviesEntity = tzSQL::getEntity('services');
            $user_serviceEntity = tzSQL::getEntity('user_service');
            $usersEntity = tzSQL::getEntity('users');
                     
            $project_id = $params['id_project'];
            $service_id = $serviesEntity->getIdForAddMember($project_id);
            $usersEntity->findOneBy('user_login_code', $login);
            
            $user_id = $usersEntity->getId();
            
            $listUser = $usersEntity->allMembersProject($project_id);
            $tab_user = array();
            
            foreach ($listUser as $value) {
                array_push($tab_user, $value['user_login']) ;
            }
            
            
            if($usersEntity && in_array($login, $tab_user)){
                
                error_log(var_export($login, true));
                //Setter
                $user_serviceEntity->setService_id($service_id);
                $user_serviceEntity->setProject_id($project_id);
                $user_serviceEntity->setUser_id($user_id);
                $user_serviceEntity->setRightKey(3);

                $user_serviceEntity->Insert();
                
            }
            
            //Add notif
            
            $notif = tzSQL::getEntity('notifications');

                $notif->setProject_id($paramsNotif['project_id']);
                $notif->setTicket_id(1);
                $notif->setUser_creator_id($paramsNotif['user_creator_id']);
                $notif->setAnnounce_id($paramsNotif['announce_id']);
                $notif->setRoadmap_id(1);
                $notif->setUser_dest_id(1);
                $notif->setService_id(1);
                $notif->setType_id(3);
                $notif->Insert();
        }

        return true;
    }


    public function newServiceAction ($params) {

        $service = tzSQL::getEntity('services');
        $service->setService_name($params['name']);
        $code = Guardian::guardUrl($params['name']);
        $service->setService_code($code);
        $service->setProject_id($params['id']);

        $service->Insert();
        //Add notif
        
        $paramsNotif = array('user_creator_id' => $user['id'],
                             'project_id' => $_POST['id'],
                             'ticket_id' => $tickets->getTicket_id()
                            );

        Guardian::guardAddNotif('newTicket', $paramsNotif);

        TzAuth::addUserSession(array('alert' => 'service'));

        return true;

    }


    public function newTicketAction () {

        $tickets = tzSQL::getEntity('tickets');

        $tickets->setTicket_name($_POST['name']);
        $code = Guardian::guardUrl($_POST['name']);
        $tickets->setTicket_code($code);
        $tickets->setTicket_date_create(date('Y-m-d'));
        $tickets->setTicket_date_update(date('Y-m-d'));
        $tickets->setTicket_deadline($_POST['deadline']);
        $tickets->setTicket_estimate_time($_POST['estimate']);
        $tickets->setTicket_spend_time(0);
        $tickets->setTicket_progress(0);
        $tickets->setTicket_description($_POST['desc']);

        $tickets->setProject_id($_POST['id']);
        $tickets->setPriority_id($_POST['priority']);
        $tickets->setStatut_id(1);
        $tickets->setTracker_id($_POST['tracker']);
        $tickets->setRoadmap_id($_POST['roadmap']);
        $tickets->setCreator_id($_SESSION['User']['id']);
        var_dump($tickets);
        $tickets->Insert();

        $uploadFile = 'media/tickets/'.$tickets->getTicket_Id();
        if (move_uploaded_file($_FILES['pjTicket']['tmp_name'], $uploadFile)) {
            $upload = true;
        }

        $receiver = tzSQL::getEntity('users_receive_tickets');

        $receiver->setUser_id($_POST['assigned']);
        $receiver->setTicket_id($tickets->getTicket_id());

        $receiver->Insert();

        //Add notif
        $user = $_SESSION['User'];
        
        $paramsNotif = array('user_creator_id' => $_SESSION['User']['id'],
                             'project_id' => $_POST['id'],
                             'ticket_id' => $tickets->getTicket_id()
                            );
                            var_dump($paramsNotif);
        Guardian::guardAddNotif('newTicket', $paramsNotif);
        TzAuth::addUserSession(array('alert' => 'ticket'));
        return true;

    }
}
