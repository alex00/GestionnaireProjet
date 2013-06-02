<?php
	session_start();
	// Global configuration for the framework
	require_once("../app/components/tiitz.class.php");
	$tiitz = new TiiTz();
	define("ROOT", realpath(__DIR__."/../")); // base of the web site

	// Array containing Main data use in Tiitz Kernel and Tiitz Controllers
	$tiitzData = array();

	// Include YAML parsing tool
	require_once(ROOT.'/app/components/spyc/Spyc.php');
	$comp = Spyc::YAMLLoad(ROOT.'/app/config/components.yml');
	$conf = Spyc::YAMLLoad(ROOT.'/app/config/config.yml');


	// Include the components contains in components.yml
	foreach ($comp as $k => $v) {
		require_once(ROOT.$v);
	}

	// Manage Error
	$error = new tzErrorExtend(0);
	
	if (!empty($conf["template"]))
		$tzRender = tzRender::getInstance($conf["template"]);
	else
		$tzRender = tzRender::getInstance("");

	if (!empty($conf["existingproject"]) && $conf["existingproject"] === true) 
		$route = tzRoute::getRoute($conf);
	else
		$route = tzRoute::getRoute($conf, "gui");

	// We fill $tiitzData with tiitz infos
	$tiitzData['route'] = $route;
	$tiitzData['conf'] = $conf;
	$tiitzData['tzRender'] = $tzRender;

	if(!empty($conf['database']['user']) && !empty($conf["existingproject"]) && $conf["existingproject"] === true) {
		tzSQL::getInstance($conf['database']['host'],$conf['database']['user'],$conf['database']['password'],$conf['database']['dbname']);
	}

	if (is_file(ROOT.$route["path"])) {
		require_once ROOT.$route["path"];

		if(!empty($route['params'])){
			foreach ($route['params'] as $value) {
				$tiitzData['params'][$value['name']] = $value['value'];
			}
		}
	}
	else {
		// Define 404 route
		$route['dirPath'] = "/src/controllers/";
		$route['path'] = "/src/controllers/pageNotFoundController.php";
		$route['action'] = "showAction";
		$route['className'] = "pageNotFoundController";

		if (is_file(ROOT.$route["path"])) {
			require_once ROOT.$route["path"];
		}
	}

	// We create the controller instance and call the requested actions
	if (class_exists($route["className"])) {
        $controller = new $route["className"]($tiitzData);

        if (method_exists($controller, $route["action"])) {
        	if(!empty($route['params'])){
        		$controller->$route["action"]($tiitzData['params']);
        	} else {
        		$controller->$route["action"]();
        	}
        }
            
        else
            tzErrorExtend::catchError(array("No action ".$route["action"]." Found", __FILE__,__LINE__));
    }
    else
        tzErrorExtend::catchError(array("No Class ".$route["className"]." Found", __FILE__,__LINE__));
