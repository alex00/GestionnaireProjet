<?php
/**
 *	This class is called when the url doesn't match with any Route.
**/
Class pageNotFoundController extends tzController {

	public function showAction () {
		include (ROOT.'/src/views/templates/pageNotFound.php');
	}
}