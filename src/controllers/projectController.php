<?php 

class projectController extends TzController {
	 public function showAction () {
         $this->tzRender->run('/templates/project',array('presentation' => 'presentation/projectPresentation.html.twig',
                                                         'toolBar' => 'toolBar/projectToolBar.html.twig',
                                                         'toolBarRules' => 'admin'));
	}
}
