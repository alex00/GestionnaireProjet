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

         $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
             'alert' => $alert,
             'nameProject' => $user['currentProject']->getProject_name(),
             'codeProject' => $user['currentProject']->getProject_code(),
             'category' => 'Tickets');

         $this->tzRender->run('/templates/ticket', array('header' => 'headers/ticketHeader.html.twig',
                                                         'modalTicket' => $modalTicket,
                                                         'currentPage' => 'tickets',
                                                         'myTickets' => $myTickets,
                                                         'alert' => $alert,
                                                         'allTickets' => $allTickets,
                                                         'infosHeader' => $infosHeader,
                                                         'subMenuCurrent' => 'tickets',
                                                         'paramsAriane' => $arianeParams));
	}

    public function ticketDetailAction ($params) {
        var_dump('lol');die;

        $project_code = $params['project'];
        $ticket_code = $params['ticket'];

        $project = Guardian::guardEntryProject($project_code);
        if (!$project)
            return(tzController::CallController("pageNotFound", "show"));

        $modalTicket = Guardian::guardModalTicket();
        $alert = Guardian::guardAlert();

        $user = TzAuth::readUser();

        $tickets = TzSQL::getEntity('tickets');

        $allTickets = $tickets->findManyBy('ticket_code', $ticket_code);

        if ($allTickets){
            foreach ($allTickets as $ticket){
                if ($ticket->getProject_id() == $user['currentProject']->getProject_id()){

                    $detailTicket = $ticket;
                }
            }
        }

        $arianeParams = array('idProject' => $user['currentProject']->getProject_id(),
            'nameProject' => $user['currentProject']->getProject_name(),
            'codeProject' => $user['currentProject']->getProject_code(),
            'categoryName' => 'announces',
            'categoryLink' => 'organization',
            'nameDetail' => $detailTicket->getTicket_name());


        $this->tzRender->run('/templates/detailAnnounce', array('header' => 'headers/roadmapHeader.html.twig',
            'subMenuCurrent' => 'organization',
            'alert' => $alert,
            'modalTicket' => $modalTicket,
            'entity' => $detailTicket,
            'paramsAriane' => $arianeParams));
    }

}
