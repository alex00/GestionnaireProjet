<?php

class tzController {

	public $tiitzData;  
    public $tzRender;
    public $conf;
    public $route;
    public $tzPlugin;
    public $tzValidator;
    private static $tiitzVersion = '0.1';
    
    public function __construct(array $tzData) {
        $this->tiitzData = $tzData;
        $this->conf = $tzData["conf"];
        $this->route = $tzData["route"];
        $this->tzRender = $tzData["tzRender"];
        //$this->tzValidator = new tzValidator;
    }

    public static function getTiitzVersion() {
        return self::$tiitzVersion;
    }

    // Made by Tiitz team for Mister Gael Coat, special dedicasse !
    protected function callController($controller, $action) {
        $controller.= "Controller";
        $action.= "Action";

        if (is_file(ROOT.$this->tiitzData['route']['dirPath'].$controller.'.php')) {
            require_once ROOT.$this->tiitzData['route']['dirPath'].$controller.'.php';

            if (class_exists($controller)) {
                $newController = new $controller($this->tiitzData);

                if (method_exists($newController, $action))
                    $newController->$action();
                else
                    tzErrorExtend::catchError(array("No action $action Found", __FILE__,__LINE__));
            }
            else
                tzErrorExtend::catchError(array("No Class $controller Found", __FILE__,__LINE__));
        }
        else
            tzErrorExtend::catchError(array('No Controller Found', __FILE__,__LINE__));
    }

}