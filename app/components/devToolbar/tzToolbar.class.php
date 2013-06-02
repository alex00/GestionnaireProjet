<?php
class DevToolbar {

	private static $route 	= array();
	private static $ini 	= array();
	private static $error	= array();
	private static $phpVersion;

	public function __construct(array $ini, array $error, $route = null){
		self::$ini 		= $ini;
		self::$route 	= $route;
		self::$error 	= $error;
	}

	public function toolbar () {
		return  ROOT.'/app/components/devToolbar/controllers/mainController.php';
	}

	public function setPhpVersion() {
		self::$phpVersion = phpversion();
	}

	public static function getPhpVersion () {
		return self::$phpVersion;
	}

	public static function getRoute () {
		return self::$route;
	}

	public static function getIni () {
		return self::$ini;
	}

	public  static function getError () {
		return self::$error;
	}
}