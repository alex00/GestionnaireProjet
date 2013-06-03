<?php 

class projectController extends TzController {
	 public function showAction () {
         $this->tzRender->run('/templates/project',array('presentation' => 'project',
                                                         'toolBar' => 'project',
                                                         'toolBarRules' => 'admin'));
	}
}
