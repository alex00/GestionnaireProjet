<?php

namespace src\helpers;
use Components\SQLEntities\TzSQL;
use Components\Auth\TzAuth;
use Components\RenderTplEngine\TzRender;

class Guardian  {

    public static function guardEntryProject($project_code){

        $projects = tzSQL::getEntity('projects');
        $exist = $projects->findManyBy('project_code',$project_code);

        if (isset($exist[0]) && $exist[0] != null){

            $rights = tzSQL::getEntity('user_service');

            $user = TzAuth::readUser();

            $lines = $rights->findManyBy('user_id',$user['id']);

            if ($lines){
                foreach ($lines as $line){

                    if ($line->getProject_id() == $exist[0]->getProject_id()){
                        $right = $line->getRightKey();
                        break;
                    }
                    else
                        $right = 4;
                }
            }
            else
                $right = 4;



            $user = TzAuth::readUser();

            if ($user['acl_group_id'] != $right){
                TzAuth::addUserSession(array('acl_group_id' => $right));
                $userEntity = tzSQL::getEntity('users');
                $userEntity->find($user['id']);

                $userEntity->setAcl_group_id($right);
                $userEntity->Update();

            }

            TzAuth::addUserSession(array('currentProject' => $exist[0]));
            $_SESSION['User']['idCurrentProject'] = $exist[0]->getProject_id();

            return true;

        }
        else {
            return false;
        }
    }

    public static function guardAlert(){

        $user = TzAuth::readUser();

        if (!isset($user['alert']))
            return false;

        $alert = $user['alert'];
        TzAuth::addUserSession(array('alert' => false));

        return $alert;

    }

    public static function guardAddNotif($type, $params){

        if (!is_array($params))
            return false;

        $user = TzAuth::readUser();

        switch ($type){
            case 'newProject':
                $notif = tzSQL::getEntity('notifications');

                $notif->setProject_id($params['project_id']);
                $notif->setTicket_id(0);
                $notif->setUser_creator_id($user['id']);
                $notif->setAnnounce_id(0);
                $notif->setRoadmap_id(0);
                $notif->setUser_dest(0);
                $notif->setService_id(0);
                $notif->setType_id(0);

            break;
        }

        $notif->Insert();

        return true;
    }

    public static function guardUrl($data){

        $data = trim($data); 
        $data = strtr($data, 
       "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ", 
       "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn"); 
        $data = strtr($data,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz"); 
        $data = preg_replace('#([^.a-z0-9]+)#i', '-', $data); 
        $data = preg_replace('#-{2,}#','-',$data); 
        $data = preg_replace('#-$#','',$data); 
        $data = preg_replace('#^-#','',$data); 
//        $url = preg_replace("`\[.*\]`U", "", $url);
//        $url = preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $url);
//        $url = htmlentities($url, ENT_COMPAT);
//        $url = preg_replace("`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i", "\\1", $url);
//        $url = preg_replace(array("`[^a-z0-9]`i", "`[-]+`"), "-", $url);
//        $url = ( $url == "" ) ? $type : strtolower(trim($url, '-'));
        return $data;
    }





    /******* Générateur de modal ******************/

    public  static function guardModalTicket() {
        $linkUser = tzSQL::getEntity('user_service');
        $user = TzAuth::readUser();

        $userByService = $linkUser->findManyBy('project_id', $user['currentProject']->getProject_id());

        $result = array();
        if ($userByService){
            foreach ($userByService as $users){

                $usersEntity = tzSQL::getEntity('users');
                $serviceEntity = tzSQL::getEntity('services');

                $usersEntity->findOneBy('id',$users->getUser_id());
                $serviceEntity->findOneBy('service_id',$users->getService_id());

                if (!isset($result['services'][$users->getService_id()]['name']))
                    $result['services'][$users->getService_id()]['name'] = $serviceEntity->getService_name();

                $result['services'][$users->getService_id()]['members'][$users->getUser_id()]['id'] = $users->getUser_id();
                $result['services'][$users->getService_id()]['members'][$users->getUser_id()]['login'] = $usersEntity->getUser_login();

            }
        }

        $roadmaps = tzSQL::getEntity('roadmaps');

        $allRoadmaps = $roadmaps->findManyBy('project_id',$user['currentProject']->getProject_id());
        if ($allRoadmaps){
            foreach ($allRoadmaps as $road){

                $result['roadmaps'][$road->getRoadmap_id()]['id'] = $road->getRoadmap_id();
                $result['roadmaps'][$road->getRoadmap_id()]['title'] = $road->getRoadmap_title();
            }
        }

        return $result;
    }



    public  static function guardModalChangeMember() {

        $services = TzSQL::getEntity('services');
        $user = TzAuth::readUser();

        $servicesProject = $services->findManyBy('project_id', $user['currentProject']->getProject_id());

        return $servicesProject;
    }
    
//    public static function guardTabMembers(){
//        $users = TzSQL::getEntity('users');
//        $listUsers = $users->findAll();
//        
//        
//    }
}