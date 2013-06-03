<?php 

class accountController extends TzController {
	 public function showAction () {
         $this->tzRender->run('/templates/project',array('presentation' => 'presentation/accountPresentation.html.twig',
                                                         'toolBar' => 'toolBar/accountToolBar.html.twig',
                                                         'toolBarRules' => 'admin'));
	}
}
