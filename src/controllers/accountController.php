<?php

class accountController extends TzController {

    public function indexAction($params) {

        $pseudo = $params['pseudo'];
        $user = new usersEntity
        
        $arianeParams = array('category' => 'My account', 'user' => $user);

        $this->tzRender->run('/templates/account', array('header' => 'headers/accountHeader.html.twig',
            'subMenu' => 'true',
            'paramsAriane' => $arianeParams,
            'user' => $user));
    }

    public function signupAction() {
        $login = htmlspecialchars($_POST["login"]);
        $pass = htmlspecialchars($_POST["pass"]);
        $mail = htmlspecialchars($_POST["mail"]);

        $password = TzAuth::encryptPwd($pass);

        $usersEntity = tzSQL::getEntity('users');

        $usersEntity->setuser_login($login);
        $usersEntity->setpassword($password);
        $usersEntity->setuser_mail($mail);
        $usersEntity->insert();
        $password = $usersEntity->getPassword();
        $login = $usersEntity->getUser_login();

        $userArray = array('password' => $pass,
            'user_login' => $login);
        TzAuth::login($userArray);
        tzController::CallController("home", "index");
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
        tzController::CallController("home", "index");
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
