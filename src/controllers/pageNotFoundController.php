<?php
/**
 * This class is call by /src/config/routing.yml
 * when no parameters are passed.
 * You can change is behavior, do what you want.
 */
class pageNotFoundController extends TzController {

	public function showAction () {
		require ROOT.'/src/views/templates/pageNotFound.php';
	}
}