<?php 

class dashboardController extends TzController {
	 public function showAction () {
         $this->tzRender->run('/templates/project',array('presentation' => 'presentation/dashboardPresentation.html.twig',
                                                         'toolBar' => 'toolBar/dashboardToolBar.html.twig',
                                                         'toolBarRules' => 'admin'));
	}
}
