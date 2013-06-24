<?php 

use Components\Auth\TzAuth;
use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;
use src\helpers\Guardian;

class organizationController extends TzController {

    public function indexAction ($params) {

        $project_code = $params['project'];
        $project = Guardian::guardEntryProject($project_code);
        if (!$project)
            return(tzController::CallController("pageNotFound", "show"));

        $modalTicket = Guardian::guardModalTicket();
        $modalChangeMember = Guardian::guardModalChangeMember();

        $user = TzAuth::readUser();

        $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
            'nameProject' => $user['currentProject']->getProject_name(),
            'codeProject' => $user['currentProject']->getProject_code(),
            'category' => 'Organization');

        $alert = Guardian::guardAlert();


        $services = TzSQL::getEntity('services');
        $link = TzSQL::getEntity('user_service');

        $servicesProject = $services->findManyBy('project_id', $user['currentProject']->getProject_id());

        foreach ( $servicesProject as $service){

            $p = $link->findManyBy('service_id', $service->getService_id());

            $fes = TzSQL::getEntity('user_service');

            if ($p){
                foreach ($p as $users){
                    $userEntity = TzSQL::getEntity('users');
                    $right = $fes->findManyBy('project_id',$user['currentProject']->getProject_id());
                    foreach ($right as $r){
                        if ($r->getService_id() == $service->getService_id() && $r->getUser_id() == $users->getUser_Id())
                            $right = $r->getRightKey();
                    }

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

            $projectServices[$service->getService_id()]['infoService']['service_name'] = $service->getService_name();
            $projectServices[$service->getService_id()]['infoService']['service_code'] = $service->getService_code();

        }


        if (isset($user['memberTab'])){
            $tab = $user['memberTab'];
            $_SESSION['User']['memberTab'] = FALSE;
        }
        else
            $tab = 0;

        $this->tzRender->run('/templates/roadmap', array('header' => 'headers/roadmapHeader.html.twig',
            'modalTicket' => $modalTicket,
            'alert' => $alert,
            'memberTab' => $tab,
            'members' => $projectServices,
            'modalChangeMember' => $modalChangeMember,
            'currentPage' => 'organization',
            'subMenuCurrent' => 'organization',
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


    public function changeMemberInfosAction () {

        $_SESSION['User']['memberTab'] = $_POST['id_tab'];

        $link = tzSQL::getEntity('user_service');


        $result = $link->findManyBy('project_id', $_POST['project_id']);

        foreach ($result as $line){

            if ($line->getService_id() == $_POST['service_id'] && $line->getUser_id() == $_POST['user_id']){

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
