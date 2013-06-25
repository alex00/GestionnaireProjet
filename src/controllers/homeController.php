<?php
use Components\Auth\TzAuth;
use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;

class homeController extends TzController {
    public function indexAction () {

        if(TzAuth::isUserLoggedIn()){
            $user = TzAuth::readUser();

            $infosHeader = array();

            $user_serviceEntity = tzSQL::getEntity('user_service');
            $users_receive_tickets = tzSQL::getEntity('users_receive_tickets');

            $infosHeader['nb_created_project'] = $user_serviceEntity->countCreatedProjects($user["id"]);
            $infosHeader['nb_affiliated_project'] = $user_serviceEntity->countAffiliatedProjects($user["id"]);

            $infosHeader['nb_assigned'] = $users_receive_tickets->countAssignedTickets($user["id"]);
            $infosHeader['nb_inprogress'] = $users_receive_tickets->countInProgressTickets($user["id"]);
            $infosHeader['nb_resolved'] = $users_receive_tickets->countResolvedTickets($user["id"]);
            $infosHeader['nb_closed'] = $users_receive_tickets->countClosedTickets($user["id"]);
            $infosHeader['nb_canceled'] = $users_receive_tickets->countCanceledTickets($user["id"]);

            $list_project_affiliated = $user_serviceEntity->listProjectAffiliated($user['id']);
            $list_project_created = $user_serviceEntity->listProjectCreated($user['id']);
            $this->tzRender->run('/templates/home', array('header' => "headers/homeHeader.html.twig",
                                                          'subMenu' => true,
                                                          'infosHeader' => $infosHeader,
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
