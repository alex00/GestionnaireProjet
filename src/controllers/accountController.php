<?php
use Components\Auth\TzAuth;
use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;
use src\helpers\Guardian;

class accountController extends TzController {

    public function indexAction($params) {

        $login = $params['login'];
        
        $usersEntity = tzSQL::getEntity('users');
        $usersEntity->findOneBy('user_login_code', $login);
        
        $user_serviceEntity = tzSQL::getEntity('user_service');
        
        $listProjectAffiliated = $user_serviceEntity->listProjectAffiliated($usersEntity->getId());
        $listProjectCreated = $user_serviceEntity->listProjectCreated($usersEntity->getId());
        $listProjectCommun = $user_serviceEntity->listProjectCommun($_SESSION['User']['id'], $usersEntity->getId());
        
        
        $arianeParams = array('category' => 'Account');

        $this->tzRender->run('/templates/account', array('header' => 'headers/accountHeader.html.twig',
            'subMenu' => 'true',
            'paramsAriane' => $arianeParams,

            'list_project_created' => $listProjectCreated,
            'list_project_affiliated' => $listProjectAffiliated,
            'list_project_commun' => $listProjectCommun,
            'user' => $usersEntity,
            'session'   => $_SESSION
            ));
    }

    public function signupAction() {
        $login = htmlspecialchars($_POST["login"]);
        $pass = htmlspecialchars($_POST["pass"]);
        $mail = htmlspecialchars($_POST["mail"]);

        $password = TzAuth::encryptPwd($pass);

        $usersEntity = tzSQL::getEntity('users');

        $usersEntity->setuser_login($login);
        $code = Guardian::guardUrl($login);
        $usersEntity->setUser_login_code($code);
        $usersEntity->setpassword($password);
        $usersEntity->setuser_mail($mail);
        $usersEntity->setAcl_group_id(3);
        $usersEntity->insert();
        $password = $usersEntity->getPassword();
        $login = $usersEntity->getUser_login();

        $userArray = array('password' => $pass,
            'user_login' => $login);
        TzAuth::login($userArray);
        header('Location: /');
    }

    public function deconnectAction() {
        TzAuth::logout();

        tzController::CallController("home", "index");
    }

    public function connectAction() {
        $login = htmlspecialchars($_POST["login"]);
        $pass = htmlspecialchars($_POST["pass"]);

        $userArray = array('password' => $pass,
            'user_login'    => $login);

        TzAuth::login($userArray);

        header('Location: /');
    }
    public function memberDetailAction($params){

        $project_name = intval($params['project']);

        $arianeParams = array('idProject' => 1,
            'nameProject' => 'Project 1',
            'category' => 'members',
            'idDetail' => '1',
            'nameDetail' => $params['member']);

        $member = array('id' => 1, 'name' => 'Deuxieme version de truc', 'description' => 'desdsescecsecsecscesecsecsece cs cse cs ec ');

        $this->tzRender->run('/templates/detailMember', array('header' => 'headers/dashboardHeader.html.twig',
            'subMenuCurrent' => 'dashboard',
            'entity' => $member,
            'homeContext' => true,
            'paramsAriane' => $arianeParams));
    }
    public function forbiddenAction(){
        echo 'forbidden';
    }
}
