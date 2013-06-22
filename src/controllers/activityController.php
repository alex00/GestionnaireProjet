<?php 
use Components\Auth\TzAuth;
use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;
use src\helpers\Guardian;

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

        $service->setService_name('not-affiliated');
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

        $announce->Insert();

        $user = tzAuth::readSession('User');

        $paramsNotif = array('announce_id' => $announce->getAnnounce_id(),
                             'user_creator_id' => $user['id'],
                             'project_id' => $announce->getProject_id());

        //self::addNotif('newAnnounce', $paramsNotif);


        return true;
    }


    public function newMemberAction ($params) {
        $logins[] = $params['login1'];
        $logins[] = $params['login2'];
        $logins[] = $params['login3'];
        $logins[] = $params['login4'];
        $logins[] = $params['login5'];

        foreach($logins as $login){

            if ($login == 'null')
                continue;

            //Add notif
        }

        return true;
    }


    public function newServiceAction ($params) {

        $service = tzSQL::getEntity('services');

        $service->setService_name($params['name']);
        $code = Guardian::guardUrl($params['name']);
        $service->setService_code($code);

        $service->Insert();
        //Add notif

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
        $tickets->setTicket_spend_time(0);
        $tickets->setTicket_progress(0);
        $tickets->setTicket_description($_POST['desc']);

        $tickets->setProject_id($_POST['id']);
        $tickets->setPriority_id($_POST['priority']);
        $tickets->setStatut_id(1);
        $tickets->setTracker_id($_POST['tracker']);
        $tickets->setRoadmap_id($_POST['roadmap']);

        $tickets->Insert();

        $receiver = tzSQL::getEntity('users_receive_tickets');

        $receiver->setUser_id($_POST['assigned']);
        $receiver->setTicket_id($tickets->getTicket_id());
        // a modifier - constraint fail

        $receiver->Insert();

        //Add notif
        return true;

    }
}
