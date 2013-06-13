<?php 

class accountController extends TzController {
	 public function showAction () {
		 echo 'Vous &ecirc;tes sur la page : account';
	}
    public function signupAction () {
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
            'user_login'    => $login);
        TzAuth::login($userArray);
        tzController::CallController("home", "index");
    }
    public function deconnectAction(){
        TzAuth::logout();

        tzController::CallController("home", "index");
    }
    public function connectAction(){
        $login = htmlspecialchars($_POST["login"]);
        $pass = htmlspecialchars($_POST["pass"]);

        $userArray = array('password' => $pass,
            'user_login'    => $login);
        TzAuth::login($userArray);
        tzController::CallController("home", "index");
    }
}
