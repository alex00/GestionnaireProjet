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

         $ticketEntity = tzSQL::getEntity('tickets');

         $myTickets = $ticketEntity->myTickets($user['id'],$user['currentProject']->getProject_id());
         $allTickets = $ticketEntity->allTickets($user['currentProject']->getProject_id());


         #check si on affiche une alert dans le header
         $alert = Guardian::guardAlert();

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
         if ($infosHeader['nb_total'] == 0)
             $infosHeader['progress'] = 0;
         else
            $infosHeader['progress'] = round(100 * $nb_finish/ $infosHeader['nb_total']);

         $t = tzSQL::getEntity('tickets');
         $statTicketsUser = $t->getTicketsByUser($user['currentProject']->getProject_id(), $user['id']);

         $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
             'alert' => $alert,
             'nameProject' => $user['currentProject']->getProject_name(),
             'codeProject' => $user['currentProject']->getProject_code(),
             'categoryName' => 'Tickets');
         
         // Liste user modal
         $tabUser = Guardian::guardTabMembersAdd($user["currentProject"]->getProject_id());

         $user_serviceEntity = tzSQL::getEntity('user_service');
         $list_project_affiliated = $user_serviceEntity->listProjectAffiliated($user['id']);
         $list_project_created = $user_serviceEntity->listProjectCreated($user['id']);
         $projectAll = array_merge($list_project_created, $list_project_affiliated);

         $this->tzRender->run('/templates/ticket', array('header' => 'headers/ticketHeader.html.twig',
                                                         'modalTicket' => $modalTicket,
                                                         'currentPage' => 'tickets',
                                                         'myTickets' => $myTickets,
                                                         'projectAll' => $projectAll,
                                                         'statTicketsUser' => $statTicketsUser,
                                                         'alert' => $alert,
                                                         'allTickets' => $allTickets,
                                                         'infosHeader' => $infosHeader,
                                                         'subMenuCurrent' => 'tickets',
                                                         'tabUsers' => $tabUser,
                                                         'paramsAriane' => $arianeParams));
	}

    public function ticketDetailAction ($params) {

        $project_code = $params['project'];

        $project = Guardian::guardEntryProject($project_code);
        if (!$project)
            return(tzController::CallController("pageNotFound", "show"));

        $infosHeader = array();
        $project_code = $params['project'];
        $ticket_code = $params['ticket'];
        $user = TzAuth::readUser();

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
        if ($infosHeader['nb_total'] == 0)
            $infosHeader['progress'] = 0;
        else
            $infosHeader['progress'] = round(100 * $nb_finish/ $infosHeader['nb_total']);

        $project = Guardian::guardEntryProject($project_code);
        if (!$project)
            return(tzController::CallController("pageNotFound", "show"));

        $modalTicket = Guardian::guardModalTicket();
        $alert = Guardian::guardAlert();

        $user = TzAuth::readUser();

        $tickets = TzSQL::getEntity('tickets');

        $user_serviceEntity = tzSQL::getEntity('user_service');
        $list_project_affiliated = $user_serviceEntity->listProjectAffiliated($user['id']);
        $list_project_created = $user_serviceEntity->listProjectCreated($user['id']);
        $projectAll = array_merge($list_project_created, $list_project_affiliated);

        $allTickets = $tickets->findManyBy('ticket_code', $ticket_code);

        if ($allTickets){
            foreach ($allTickets as $ticket){
                if ($ticket->getProject_id() == $user['currentProject']->getProject_id()){

                    $detailTicket = $tickets->getDetailTicket($user['currentProject']->getProject_id(),$ticket->getTicket_id());
                }
            }
        }
        
        // Liste user modal
         $tabUser = Guardian::guardTabMembersAdd($user["currentProject"]->getProject_id());

        $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
            'nameProject' => $user['currentProject']->getProject_name(),
            'codeProject' => $user['currentProject']->getProject_code(),
            'categoryName' => 'tickets',
            'categoryLink' => 'tickets',
            'nameDetail' => $detailTicket['ticket_name']);

        $this->tzRender->run('/templates/detailTicket', array('header' => 'headers/ticketHeader.html.twig',
            'subMenuCurrent' => 'tickets',
            'alert' => $alert,
            'detailContext' => true,
            'currentPage' => 'ticket',
            'projectAll' => $projectAll,
            'infosHeader' => $infosHeader,
            'detailCode' => $detailTicket['ticket_code'],
            'modalTicket' => $modalTicket,
            'entity' => $detailTicket,
            'tabUsers' => $tabUser,
            'paramsAriane' => $arianeParams));
    }



    public function changeTimeTicketAction(){

        $id = intval($_POST['ticket_id']);

        $tickets = TzSQL::getEntity('tickets');

        $tickets->findOneBy('ticket_id',$id);

        if ($tickets == null)
            return false;

        $tickets->setTicket_progress($_POST['progress']);
        $tickets->setTicket_spend_time($_POST['spend']);

        $tickets->Update();

        TzAuth::addUserSession(array('alert' => 'modifyTicket'));
        return true;


    }

    public function modifyTicketAction (){
        $id = intval($_POST['id_ticket']);

        $tickets = TzSQL::getEntity('tickets');

        $tickets->findOneBy('ticket_id',$id);

        if ($tickets == null)
            return false;

        $tickets->setTicket_name($_POST['name']);
        $code = Guardian::guardUrl($_POST['name']);
        $tickets->setTicket_code($code);
        $tickets->setTicket_deadline($_POST['deadline']);
        $tickets->setTicket_description($_POST['desc']);

        $tickets->setProject_id($_POST['id']);
        $tickets->setPriority_id($_POST['priority']);
        $tickets->setStatut_id($_POST['statut']);
        $tickets->setTracker_id($_POST['tracker']);
        $tickets->setRoadmap_id($_POST['roadmap']);
        var_dump($tickets);
        $tickets->Update();

        TzAuth::addUserSession(array('alert' => 'modifyTicket'));
        return true;
    }

}
