<?php 

class taskController extends TzController {
	 public function showAction () {
         $this->tzRender->run('/templates/project',array('presentation' => 'presentation/taskPresentation.html.twig',
                                                         'toolBar' => 'toolBar/taskToolBar.html.twig',
                                                         'toolBarRules' => 'admin'));
	}
}
