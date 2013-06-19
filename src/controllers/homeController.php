<?php

class homeController extends TzController {
    public function indexAction () {
        
        if(TzAuth::isUserLoggedIn()){
            $userEntity = tzSQL::getEntity('Users');
            $user = $userEntity->find($_SESSION['User']['id']);
        
            $this->tzRender->run('/templates/home', array('header' => "headers/homeHeader.html.twig",
                                                          'subMenu' => true,
                                                          'homeContext' => true,
                                                          'paramsAriane' => array()));
        }
        else{
            $this->tzRender->run('/templates/connect');
        }
    }


    public function newProjectAction () {

        $project = tzSQL::getEntity('projects');

        $project->setProject_name($_POST['nameProject']);
        $project->setProject_description($_POST['descProject']);
        $project->setProject_date_create(date('Y-m-d'));
        $code = trim(str_replace(" ","-",$_POST['nameProject']));
        $project->setProject_code($code);

        $project->Insert();

        header("Location: http://projectmanager.dev/".$code);
    }
}
