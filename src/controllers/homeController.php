<?php
use Components\Auth\TzAuth;
use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;

class homeController extends TzController {
    public function indexAction () {

        if(TzAuth::isUserLoggedIn()){
            $user = TzAuth::readUser();

            $user_serviceEntity = tzSQL::getEntity('user_service');
            $users_receive_tickets = tzSQL::getEntity('users_receive_tickets');

            $nb_created_project = $user_serviceEntity->countCreatedProjects($user["id"]);
            $nb_affiliated_project = $user_serviceEntity->countAffiliatedProjects($user["id"]);

            $nb_assigned = $users_receive_tickets->countAssignedTickets($user["id"]);
            $nb_inprogress = $users_receive_tickets->countInProgressTickets($user["id"]);
            $nb_resolved = $users_receive_tickets->countResolvedTickets($user["id"]);
            $nb_closed = $users_receive_tickets->countClosedTickets($user["id"]);
            $nb_canceled = $users_receive_tickets->countCanceledTickets($user["id"]);
            
            $list_project_affiliated = $user_serviceEntity->listProjectAffiliated($user['id']);
            $list_project_created = $user_serviceEntity->listProjectCreated($user['id']);
            


            $this->tzRender->run('/templates/home', array('header' => "headers/homeHeader.html.twig",
                                                          'subMenu' => true,
                                                          'nb_created_project' => $nb_created_project,
                                                          'nb_affiliated_project' => $nb_affiliated_project,
                                                          'nb_assigned' => $nb_assigned,
                                                          'nb_inprogress' => $nb_inprogress,
                                                          'nb_inprogress' => $nb_inprogress,
                                                          'nb_resolved' => $nb_resolved,
                                                          'nb_closed' => $nb_closed,
                                                          'nb_canceled' => $nb_canceled,
                                                          'list_project_affiliated' => $list_project_affiliated,
                                                          'list_project_created' => $list_project_created,
                                                          'homeContext' => true,
                                                          'paramsAriane' => array()));
        }
        else{
            $this->tzRender->run('/templates/connect');
        }
    }


}
