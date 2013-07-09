<?php 

use Components\Auth\TzAuth;
use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;

use src\entities;
use src\helpers\Guardian;

class organizationController extends TzController {

    public function indexAction ($params) {

        $project_code = $params['project'];
        $project = Guardian::guardEntryProject($project_code);
        if (!$project)
            return(tzController::CallController("pageNotFound", "show"));

        # chargement des deux modaux dans le layout

        $modalTicket = Guardian::guardModalTicket();
        $modalChangeMember = Guardian::guardModalChangeMember();

        $user = TzAuth::readUser();

        $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
            'nameProject' => $user['currentProject']->getProject_name(),
            'codeProject' => $user['currentProject']->getProject_code(),
            'categoryName' => 'Organization');

        #check si on affiche une alert dans le header
        $alert = Guardian::guardAlert();


        $services = TzSQL::getEntity('services');
        $link = TzSQL::getEntity('user_service');

        $servicesProject = $services->findManyBy('project_id', $user['currentProject']->getProject_id());
        # on recupère les services lié au project
        foreach ( $servicesProject as $service){

            # on récupére les users lié a chaque service
            $p = $link->findManyBy('service_id', $service->getService_id());

            if ($p){
                foreach ($p as $users){

                    $userEntity = TzSQL::getEntity('users');
                    $right = $users->getRightKey();
                    # on enregistre chaque users dans le tableau final avec l'id du service pour index
                    $userEntity->findOneBy('id',$users->getUser_id());

                    if (!isset($projectServices[$service->getService_id()]['infoUsers'][$userEntity->getId()])){
                        $projectServices[$service->getService_id()]['infoUsers'][$userEntity->getId()] = $userEntity;
                        $projectServices[$service->getService_id()]['infoUsers'][$userEntity->getId()]->right = $right;
                    }
                }
            }
            else{
                $projectServices[$service->getService_id()]['infoUsers'] = 'none';
            }

            if (isset($projectServices[$service->getService_id()]['infoService']))
                continue;
            # on enregistre les infos du service avec son id comme index dans le tableau final

            $projectServices[$service->getService_id()]['infoService']['service_name'] = $service->getService_name();
            $projectServices[$service->getService_id()]['infoService']['service_code'] = $service->getService_code();

        }

        # affichage ou non d'un service par défault
        if (isset($user['memberTab'])){
            $tab = $user['memberTab'];
            $_SESSION['User']['memberTab'] = FALSE;
        }
        else
            $tab = 0;


        $allAnnounces = tzSQL::getEntity('announces');
        $announces = $allAnnounces->allAnnounces($user['currentProject']->getProject_id());


        $allRoadmaps = tzSQL::getEntity('roadmaps');
        $roadmaps = $allRoadmaps->allRoadmaps($user['currentProject']->getProject_id());


        $user_serviceEntity = tzSQL::getEntity('user_service');
        $list_project_affiliated = $user_serviceEntity->listProjectAffiliated($user['id']);
        $list_project_created = $user_serviceEntity->listProjectCreated($user['id']);
        $projectAll = array_merge($list_project_created, $list_project_affiliated);

        // Liste user modal
         $tabUser = Guardian::guardTabMembersAdd($user["currentProject"]->getProject_id());


        ######## GET des notifications pour l'affichage header ##############
        $notifs = Guardian::guardGetNotifs();

        $infosHeader = array();
        $infosHeader['nb_members_project'] = $link->countMembersProjectNew($user['currentProject']->getProject_id());
        $infosHeader['nb_announces'] = $allAnnounces->countAnnouncesProject($user["currentProject"]->getProject_id());
        $infosHeader['nb_roadmaps'] = $allRoadmaps->countRoadmapsProject($user["currentProject"]->getProject_id());
        $infosHeader['last_announce'] = $allAnnounces->getLastAnnounce($user["currentProject"]->getProject_id());

        $this->tzRender->run('/templates/roadmap', array('header' => 'headers/roadmapHeader.html.twig',
            'modalTicket' => $modalTicket,
            'alert' => $alert,
            'memberTab' => $tab,
            'projectAll' => $projectAll,
            'notifs' => $notifs,
            'announces' => $announces,
            'roadmaps' => $roadmaps,
            'infosHeader' => $infosHeader,
            'members' => $projectServices,
            'modalChangeMember' => $modalChangeMember,
            'currentPage' => 'organization',
            'subMenuCurrent' => 'organization',
            'tabUsers' => $tabUser,
            'paramsAriane' => $arianeParams));
    }

    public function roadmapDetailAction ($params) {

        $project_code = $params['project'];
        $roadmap_code = $params['roadmap'];

        $project = Guardian::guardEntryProject($project_code);
        if (!$project)
            return(tzController::CallController("pageNotFound", "show"));

        $modalTicket = Guardian::guardModalTicket();

        #check si on affiche une alert dans le header
        $alert = Guardian::guardAlert();

        $user = TzAuth::readUser();

        $roadmaps = TzSQL::getEntity('roadmaps');

        $allRoadmaps = $roadmaps->findManyBy('roadmap_code', $roadmap_code);

        if ($allRoadmaps){
            foreach ($allRoadmaps as $roadmap){
                if ($roadmap->getProject_id() == $user['currentProject']->getProject_id()){

                    $detailRoadmap = $roadmap;
                }
            }
        }
        $roadmapId = $detailRoadmap->getRoadmap_id();
        $commentsEntity = TzSQL::getEntity('comments');
        $comments = $commentsEntity->findAllComments('roadmap_id',$roadmapId);

        $roadmaps = TzSQL::getEntity('roadmaps');

        $allTickets = $roadmaps->ticketsByRoadmap($user['currentProject']->getProject_id(), $detailRoadmap->getRoadmap_id());

        $stats = $roadmaps->statsProgressRoadmap($user['currentProject']->getProject_id(), $detailRoadmap->getRoadmap_id());

        $detailRoadmap->tickets = $allTickets;
        $detailRoadmap->progress = $stats;


        $user_serviceEntity = tzSQL::getEntity('user_service');
        $list_project_affiliated = $user_serviceEntity->listProjectAffiliated($user['id']);
        $list_project_created = $user_serviceEntity->listProjectCreated($user['id']);
        $projectAll = array_merge($list_project_created, $list_project_affiliated);
        $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
            'nameProject' => $user['currentProject']->getProject_name(),
            'codeProject' => $user['currentProject']->getProject_code(),
            'categoryName' => 'roadmaps',
            'categoryLink' => 'organization',
            'nameDetail' => $detailRoadmap->getRoadmap_title());



        ######## GET des notifications pour l'affichage header ##############
        $notifs = Guardian::guardGetNotifs();


        $this->tzRender->run('/templates/detailRoadmap', array('header' => 'headers/roadmapHeader.html.twig',
            'subMenuCurrent' => 'organization',
            'currentPage' => 'organization',
            'detailContext' => true,
            'currentPage' => 'ticket',
            'comments'    => $comments,
            'detailCode' => $detailRoadmap->getRoadmap_code(),
            'alert' => $alert,
            'notifs' => $notifs,
            'projectAll' => $projectAll,
            'entity' => $detailRoadmap,
            'modalTicket' => $modalTicket,
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

        $roadmap->setCreator_id($_SESSION['User']['id']);
        $roadmap->setProject_id($params['id']);

        $roadmap->Insert();
        
        $paramsNotif = array('roadmap_id' => $roadmap->getRoadmap_id(),
                             'user_creator_id' => $_SESSION['User']['id'],
                             'project_id' => $params['id']);

        Guardian::guardAddNotif('newRoadmap', $paramsNotif);


        TzAuth::addUserSession(array('alert' => 'roadmap'));

        return true;

    }


    public function changeMemberInfosAction () {

        $_SESSION['User']['memberTab'] = $_POST['id_tab'];

        $link = tzSQL::getEntity('user_service');

        $result = $link->findManyBy('project_id', $_POST['project_id']);

        foreach ($result as $line){

            if ($line->getUser_id() == $_POST['user_id']){
                $lineLink = tzSQL::getEntity('user_service');

                $lineLink->find($line->getId());
            }
        }

        $lineLink->setService_id($_POST['service_id']);

        $lineLink->setRightKey($_POST['right']);

        $lineLink->Update();



        return true;

    }

}
