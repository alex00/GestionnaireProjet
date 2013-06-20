<?php 

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
        $code = trim(str_replace(" ","-",$params['name']));
        $project->setProject_code($code);

        $project->Insert();

        /*$newProject = tzSQL::getEntity('projects');
        $newProject->findOneBy('project_name',$params['name']);

*/
        $service = tzSQL::getEntity('services');

        $service->setProject_id(1);
        $service->setService_name('no-affiliated');
        $service->setService_code('no-affiliated');
        $service->Insert();

        echo $code;

        return true;
    }



    public function newAnnounceAction ($params) {

        $announce = tzSQL::getEntity('announces');

        $announce->setAnnounce_title($params['name']);
        $code = trim(str_replace(" ","-",$params['name']));
        $announce->setAnnounce_code(strtolower(($code)));
        $announce->setAnnounce_date_create(date('Y-m-d'));
        $announce->setAnnounce_date_update(date('Y-m-d'));
        $announce->setAnnounce_description($params['desc']);

        $announce->setProject_id($params['id']);

        $announce->Insert();

    }


    public function newMemberAction ($params) {
        $logins[] = $params['login1'];
        $logins[] = $params['login2'];
        $logins[] = $params['login3'];
        $logins[] = $params['login4'];
        $logins[] = $params['login5'];

        $service = tzSQL::getEntity('services');
        foreach($logins as $login){

            if ($login == 'null')
                continue;
            $service->setService_name($login);
            $code = trim(str_replace(" ","-",$login));
            $service->setService_code(strtolower(($code)));

            $service->setProject_id($params['id']);

            $service->Insert();
        }
    }


    public function newServiceAction ($params) {

        $service = tzSQL::getEntity('services');

        $service->setService_name($params['name']);
        $code = trim(str_replace(" ","-",$params['name']));
        $service->setService_code(strtolower(($code)));

        $service->setProject_id($params['id']);

        $service->Insert();

    }
}
