<?php

/**
 * Reminder error
 * $errorlevels = array(
 *       2047 => 'E_ALL',
 *       1024 => 'E_USER_NOTICE',
 *       512 => 'E_USER_WARNING',
 *       256 => 'E_USER_ERROR',
 *       128 => 'E_COMPILE_WARNING',
 *       64 => 'E_COMPILE_ERROR',
 *       32 => 'E_CORE_WARNING',
 *       16 => 'E_CORE_ERROR',
 *       8 => 'E_NOTICE',
 *       4 => 'E_PARSE',
 *       2 => 'E_WARNING',
 *       1 => 'E_ERROR');
 */
// Core Manager error
abstract class tzErrorCore {
	
	private static $file 				= "error.log";
	private static $path 				= "/app/log/";
	// true : Display error / false : no display
	protected static $displayError 		= true;
	// Array of error
	protected static $currentError	 	= array();
	// Lenght of $currentError array : useful to add \n 
	// at the end of a line when we write the error in the log file
	protected static $lenghtArray 		= 5;
	// Array of all the error in the log file
	protected $allErrorFromLog			= array();
	// increment use in highlight_linesfile()
	private static $increment			= 0;
	// count current number of error
	private static $counterCurrentError	= 0;
	// store error in html template
	private static $templateError 		= array();
	private static $templateCodePhp 	= array();
	// number of error that can be return to be displayed in the toolbar
	private static $numberOfErrorToolbar;
	// code of fatal error from php
	private static $fatalErrorCode = array(1,4,16,64,256,4096);
	// page not found
	protected $pageNotFound = '/app/components/error/views/error.html';

	private function __construct () {
		
	}

	/**
	 * the flow when an error is received : display and save
	 * @return void 
	 */
	protected static function displaySaveError() {
		// call number to increment number of current error
		self::numberCurrentError();
		// length of $currentError
		self::$lenghtArray = count(self::$currentError);
		// Display current error
		if (self::$displayError === true) {
			self::errorTpl(self::$currentError);
		}	
		// save in log file
	    self::saveInfile();
	}

	/**
	 * Register the number of new error in the system
	 * @return void
	 */
	private static function numberCurrentError () {
		self::$counterCurrentError++;
	}

	/**
	 * Template that is going to be displayed
	 * @param  array  $error  Store type, line, message, date, trace, code
	 * @return void
	 */
	protected static function errorTpl(array $error) {

		if ($error['type'] == 1 || $error['type'] == 64) {
			$store = '<div class="tiitz-error-popup" style="width:100%;color: #000;background-color: #F2DEDE;border-color: #EED3D7;margin: 0px; padding-left:8px;padding-right:8px;font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;margin:auto !important;font-size:14px;">';
		} else {
			$store = '<div class="tiitz-error-popup" style="color: #000;background-color: #FCF8E3;border : 1px solid #FBEED5;margin: 0px; padding-left:8px;padding-right:8px;font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;margin:auto !important;">';
					//<a class="close" data-dismiss="alert" href="#">&times;</a>
		}

		$store .= '	<ul style="list-style-type:none;margin: 0px;padding:5px;margin:auto !important;">
					<h4 style="margin:5px 0px;font-size:16px">';
		(isset($error['type']) && in_array($error['type'], self::$fatalErrorCode)) ? $store .= "Erreur Fatale" : $store .= "Erreur durant l'execution du script";
		$store .= '</h4>';
		// loop through error array
		foreach ($error as $key => $value) {
			if(is_array($value)) {
				self::errorTpl($value);
			} else {
				$store .= '<li><strong>["'.$key.'"]</strong> : '.$value.'</li>';
			}
		}
		
		$store .= '</ul></div>';
		array_push(self::$templateError, $store);
		// when a fatal error occur, the toobar can't be display
	    // so we print directly the message error send by php
		if (in_array($error['type'], self::$fatalErrorCode)) {
	     	 print $store;
	    }
		self::highlight_linesfile($error['file'], $error['line'],$error['type'], $return = false);
	}

	public static function highlight_linesfile($filename, $lineError, $errorType, $return = false) { 
		
	    if(file_exists($filename) && is_file($filename)) { 

	        $output = '<pre  class="accordion" id="accordion2" style="margin: 0px auto;padding: 0px 8px;"><code><span style="color: '.ini_get('highlight.html').';font-size: 12px;">'; 
	        
	        $code = substr(highlight_file($filename, true), 36, -15); 
	        $start_line = 1; 
	        $lines = explode('<br />', $code); 
	       
	        $chr_lines = count($lines); 
	        $chr_lines = strlen($chr_lines); 
	        
			$output .= '<div id="collapse'.self::$increment.'" class="accordion-body collapse">';
	        foreach($lines as $line) 
	        {   
	        	$output .= "<p style='margin:auto;'";
	        	if ($start_line%2 == 0) {
	        		$output .= "background-color:#f1f1f1;'";
	        	}
	        	$output .= ">";
	        	$nline = str_pad($start_line, $chr_lines, ' ', STR_PAD_LEFT); 
		        if($lineError == $start_line) {
		        	$output .= '<span style="color: #f1f1f1; background-color: red;" class="php_highlight_line">'.$nline. ': '.$line."</span>\n"; 
		        }  else {
		        	$output .= '<span style="color: grey;" class="php_highlight_line">'.$nline. ':</span> '.$line."\n"; 
		        } 
		        $output .= "</p>"; 
		        $start_line ++; 
		    } 
	        $output	.= '</div>';
	        $output .= '</span></code></pre>'; 
	        
	        self::$increment++;

	        if($return === true) {
	        	return $return; 
	        }
	        else {
	        	array_push(self::$templateCodePhp, $output);
	        	// when a fatal error occur, the toobar can't be display
	        	// so we print directly the message error send by php
	        	if (in_array($errorType, self::$fatalErrorCode)) {
	        		print $output;
	        	}
	        } 
	    } 
	} 

	/**
	 * Save the error in the log file
	 * @return void
	 */
	protected static function saveInfile(){
		
		$line = '';
		$i = 1;
		foreach (self::$currentError as $key => $value) {
			if ($i < self::$lenghtArray) {
				$line .= $key .'=>'.str_replace("\n"," ",$value)."\t";
			} else {
				$line .= $key .'=>'.str_replace("\n"," ",$value);
			}
			$i++;	
		}
		$line .= "\n";
		// write error in the log file
		@file_put_contents(ROOT.self::$path.self::$file, $line, FILE_APPEND);
	}
	
	/**
	 * format all error from the log file in a array
	 * @return void
	 */
	private function arrayFormatError() {
		$currentError = array();
		$handle = @fopen(ROOT.self::$path.self::$file, "rb");
		
		if ($handle) {
			while (false !== ($line = fgets($handle))) {
				// We need to remove \n from the array
				$line 		= str_replace("\n","|",$line);
				$newEntry 	= explode("\t", $line);
				$i = 1;
				
				foreach ($newEntry as $key => $value) {
					$current = explode('=>', $value);
					if($i < self::$lenghtArray) {
						$currentError[$current[0]] = $current[1];

					} else {
						$currentError[$current[0]] = substr($current[1],0,-1);
					}
					$i++;
				}
				$i = 1;
				array_push($this -> allErrorFromLog, $currentError);				
				unset($currentError);
	      	}
    	}
    	$this -> allErrorFromLog = array_reverse($this -> allErrorFromLog);
	}

	/**
	 * getter
	 * @return [array] retrieve an array of log error
	 */
	public function exportArray() {
		if(file_exists(ROOT.self::$path.self::$file)){
			$this -> arrayFormatError();
		}
		return $this -> allErrorFromLog;				
	}
	/**
	 * export last errors from log file
	 * @param  int $nb number of errors exported
	 * @return array     errors
	 */
	public function exportLastErrors($nb) {
		return null;
	}
	/**
	 * getter
	 * @return [array] retrieve all log errer in Json format
	 */
	public function exportJson() {
		if(file_exists(ROOT.self::$path.self::$file)){
			$this -> arrayFormatError();
		}	
		return json_encode($this->allErrorFromLog);	
	}

	// getter
	private static function getCurrentError	() {
		return self::$currentError;
	}

	public static function getPath() {
		return self::$path;
	}

	public static function getFile(){
		return self::$file;
	}

	public function getDisplayError() {
		return self::$displayError;
	}
	
	public static function getNumberOfCurrentError() {
		return self::$counterCurrentError;
	}
	public static function getTemplateError(){
		return self::$templateError;
	}

	public static function getTemplateCodePhp(){
		return self::$templateCodePhp;
	}
	// setter
	protected function setDisplayError($isDisplay) {
		self::$displayError = $isDisplay;
	}
}