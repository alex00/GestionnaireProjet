<?php 


use Components\Auth\TzAuth;
use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;
use src\helpers\Guardian;

class ticketController extends TzController {
	 public function indexAction ($params) {

         $project_code = $params['project'];

         $project = Guardian::guardEntryProject($project_code);
         if (!$project)
             return(tzController::CallController("pageNotFound", "show"));
         $modalTicket = Guardian::guardModalTicket();

         $user = TzAuth::readUser();
         $infosHeader = array();

         $ticketsEntity = tzSQL::getEntity('tickets');

         $infosHeader['nb_total'] = $ticketsEntity->countTicketsTotal($user['currentProject']->getProject_id());
         $infosHeader['nb_assigned'] = $ticketsEntity->countAssignedTickets($user['currentProject']->getProject_id());
         $infosHeader['nb_inprogress'] = $ticketsEntity->countInprogressTickets($user['currentProject']->getProject_id());
         $infosHeader['nb_resolved'] = $ticketsEntity->countResolvedTickets($user['currentProject']->getProject_id());
         $infosHeader['nb_closed'] = $ticketsEntity->countClosedTickets($user['currentProject']->getProject_id());
         $infosHeader['nb_canceled'] = $ticketsEntity->countCanceledTickets($user['currentProject']->getProject_id());
         $infosHeader['nb_evolution'] = $ticketsEntity->countEvolutionTickets($user['currentProject']->getProject_id());
         $infosHeader['nb_bug'] = $ticketsEntity->countBugTickets($user['currentProject']->getProject_id());
         $infosHeader['nb_support'] = $ticketsEntity->countSupportTickets($user['currentProject']->getProject_id());

         $nb_finish = intval($infosHeader['nb_closed'] +  $infosHeader['nb_canceled']);
         $infosHeader['progress'] = round(100 * $nb_finish/ $infosHeader['nb_total']);
         $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
             'nameProject' => $user['currentProject']->getProject_name(),
             'codeProject' => $user['currentProject']->getProject_code(),
             'category' => 'Tickets');

         $this->tzRender->run('/templates/ticket', array('header' => 'headers/ticketHeader.html.twig',
                                                         'modalTicket' => $modalTicket,
                                                         'infosHeader' => $infosHeader,
                                                         'currentPage' => 'tickets',
                                                         'subMenuCurrent' => 'tickets',
                                                         'paramsAriane' => $arianeParams));
	}

    public function detailAction ($params) {

        $project_name = intval($params['project']);

        $arianeParams = array('idProject' => 1,
            'nameProject' => 'Project 1',
            'category' => 'tickets',
            'idDetail' => '1',
            'nameDetail' => $params['ticket']);

        $ticket = array('id' => 1, 'name' => 'Deuxieme version de truc', 'description' => 'desdsescecsecsecscesecsecsece cs cse cs ec ');

        $this->tzRender->run('/templates/detail', array('header' => 'headers/ticketHeader.html.twig',
            'subMenuCurrent' => 'tickets',
            'entity' => $ticket,
            'paramsAriane' => $arianeParams));
    }

    public function getModalDataAction($params){

        switch ($params['id_action']){
            case 'addTicketLink':
                $linkEntity = tzSQL::getEntity('user_service_project');
                $serviceEntity = tzSQL::getEntity('services');
                $userEntity = tzSQL::getEntity('users');

                $selectMember = "<select name='assignedTicket' id='assignedTicket'>";

                /*$lineLink = $linkEntity->findManyBy('project_id', $params['id_project']);

                foreach ($lineLink as $line){
                    $serviceEntity->setService_Id($line['service_id']);
                    $serviceEntity->Update();

                    $selectMember .= '<option style="headerGroupSelect" value="'.$serviceEntity->getService_id.'" >'.$serviceEntity->getService_name.'</option>';
                    $lineService = $linkEntity->findBy('service_id', $params['id_service']);
                    foreach ($lineService as $lineSer){
                        $userEntity->setId($lineSer['user_id']);
                        $userEntity->Update();

                        $selectMember .= '<option value="'.$userEntity->getId.'" >'.$serviceEntity->getUser_login.'</option>';
                    }
                }
*/
                $selectMember .= '</select>';


                $roadmapEntity = tzSQL::getEntity('roadmap');
                $selectRoadmap ="<select name='roadmapTicket' id='roadmapTicket'>";
/*
                $roadmaps = $roadmapEntity->findManyBy('project_id', $params['id_project']);

                foreach ($roadmaps as $roadmap){
                    $selectRoadmap .= "<option value='".$roadmap->roadmap_id."' s>".$roadmap->roadmap_name."</option>";
                }*/

                $selectRoadmap .= "</select>";

                $tickets['selectMember'] = $selectMember;
                $tickets['selectRoadmap'] = $selectRoadmap;

                echo json_encode($selectRoadmap);

            break;
        }

        return true;
    }
}
