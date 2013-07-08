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

        $this->tzRender->run('/templates/activity', array('header' => 'headers/activityHeader.html.twig',
            'modalTicket' => $modalTicket,
            'alert' => $alert,
            'projectAll' => $projectAll,
            'currentPage' => 'activity',
            'subMenuCurrent' => 'activity',
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


        $this->tzRender->run('/templates/detailAnnounce', array('header' => 'headers/roadmapHeader.html.twig',
            'subMenuCurrent' => 'organization',
            'entity' => $detailAnnounce,
            'projectAll' => $projectAll,
            'alert' => $alert,
            'modalTicket' => $modalTicket,
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

        $user = tzAuth::readSession('User');

        $paramsNotif = array('announce_id' => $announce->getAnnounce_id(),
                             'user_creator_id' => $user['id'],
                             'project_id' => $announce->getProject_id());

        //self::addNotif('newAnnounce', $paramsNotif);

        TzAuth::addUserSession(array('alert' => 'announce'));

        return true;
    }


    public function newMemberAction ($params) {
        $logins[] = $params['login1'];
        $logins[] = $params['login2'];
        $logins[] = $params['login3'];
        $logins[] = $params['login4'];
        $logins[] = $params['login5'];

        $users = tzSQL::getEntity('users');

        foreach($logins as $login){

            $pos = strpos($login, '@');
            if (!$pos){
                //add mailer
            }

            //Add notif
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
        TzAuth::addUserSession(array('alert' => 'ticket'));
        return true;

    }
}
