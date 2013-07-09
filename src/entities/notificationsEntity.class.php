<?php
		use Components\SQLEntities\TzSQL;
		use Components\DebugTools\DebugTool;

		class notificationsEntity {
					
			private $notification_id;
			
			private $project_id;
			
			private $ticket_id;
			
			private $user_creator_id;
			
			private $announce_id;
			
			private $roadmap_id;
			
			private $service_id;
			
			private $type_id;
			
			private $create_at;
			
            private $relations = array('notifiaction_types'=>array('type_id'=>'type_id'),);
        
            private $notifiaction_types;
            



			/********************** GETTER ***********************/
			

			public function getNotification_id(){
				return $this->notification_id;
			}

			

			public function getProject_id(){
				return $this->project_id;
			}

			

			public function getTicket_id(){
				return $this->ticket_id;
			}

			

			public function getUser_creator_id(){
				return $this->user_creator_id;
			}

			

			public function getAnnounce_id(){
				return $this->announce_id;
			}

			

			public function getRoadmap_id(){
				return $this->roadmap_id;
			}

			

			public function getService_id(){
				return $this->service_id;
			}

			

			public function getType_id(){
				return $this->type_id;
			}

			

			public function getCreate_at(){
				return $this->create_at;
			}

			
			/********************** SETTER ***********************/

			public function setNotification_id($val){
				$this->notification_id =  $val;
			}

					

			public function setProject_id($val){
				$this->project_id =  $val;
			}

					

			public function setTicket_id($val){
				$this->ticket_id =  $val;
			}

					

			public function setUser_creator_id($val){
				$this->user_creator_id =  $val;
			}

					

			public function setAnnounce_id($val){
				$this->announce_id =  $val;
			}

					

			public function setRoadmap_id($val){
				$this->roadmap_id =  $val;
			}

					

			public function setService_id($val){
				$this->service_id =  $val;
			}

					

			public function setType_id($val){
				$this->type_id =  $val;
			}

					

			public function setCreate_at($val){
				$this->create_at =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->notification_id)){

					$sql = "DELETE FROM notifications WHERE notification_id = ".intval($this->notification_id).";";

					$result = TzSQL::getPDO()->prepare($sql);
					$result->execute();

					return $result;
				}
				else{
					DebugTool::$error->catchError(array('Fail delete', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** Update ***********************/

			public function Update(){

				$sql = 'UPDATE `notifications` SET `notification_id` = "'.$this->notification_id.'", `project_id` = "'.$this->project_id.'", `ticket_id` = "'.$this->ticket_id.'", `user_creator_id` = "'.$this->user_creator_id.'", `announce_id` = "'.$this->announce_id.'", `roadmap_id` = "'.$this->roadmap_id.'", `service_id` = "'.$this->service_id.'", `type_id` = "'.$this->type_id.'", `create_at` = "'.$this->create_at.'" WHERE notification_id = '.intval($this->notification_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->notification_id)){
					if($result)
						return true;
					else{
						DebugTool::$error->catchError(array('Fail update', __FILE__,__LINE__, true));
						return false;
					}
				}
				else{
					DebugTool::$error->catchError(array('Fail update: primkey is null', __FILE__,__LINE__, true));
					return false;
				}
			}

			/********************** Insert ***********************/

			public function Insert(){

				$this->notification_id = '';

				$sql = 'INSERT INTO notifications (`notification_id`,`project_id`,`ticket_id`,`user_creator_id`,`announce_id`,`roadmap_id`,`service_id`,`type_id`,`create_at`) VALUES ("'.$this->notification_id.'","'.$this->project_id.'","'.$this->ticket_id.'","'.$this->user_creator_id.'","'.$this->announce_id.'","'.$this->roadmap_id.'","'.$this->service_id.'","'.$this->type_id.'","'.$this->create_at.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->notification_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll($recursif = 'yes'){

				$sql = 'SELECT * FROM notifications';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new notificationsEntity();

					foreach ($data as $k => $value) {

						$method = 'set'.ucfirst($k);
						$tmpInstance->$method($value);

						if($recursif == null){
                            foreach($this->relations as $relationId => $relationLinks){
                                if(array_key_exists($k, $relationLinks)){
                                    $entity = tzSQL::getEntity($relationId);
                                    $content =  $entity->findManyBy($relationLinks[$k],$value, 'no');
                                    $tmpInstance->$relationId = $content;
                                }
                            }
                        }
					}
					array_push($entitiesArray, $tmpInstance);
				}

				if(!empty($entitiesArray))
					return $entitiesArray;
				else{
					DebugTool::$error->catchError(array('No results', __FILE__,__LINE__, true));
					return false;
				}						

			}

			/************* FindOneBy(column, value) ***************/
			public function findOneBy($param,$value){


				switch ($param){
					
					case $param == 'notification_id':
						$param = 'notification_id';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					case $param == 'user_creator_id':
						$param = 'user_creator_id';
						break;
						
					case $param == 'announce_id':
						$param = 'announce_id';
						break;
						
					case $param == 'roadmap_id':
						$param = 'roadmap_id';
						break;
						
					case $param == 'service_id':
						$param = 'service_id';
						break;
						
					case $param == 'type_id':
						$param = 'type_id';
						break;
						
					case $param == 'create_at':
						$param = 'create_at';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM notifications WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->notification_id = $result->notification_id;
					$this->project_id = $result->project_id;
					$this->ticket_id = $result->ticket_id;
					$this->user_creator_id = $result->user_creator_id;
					$this->announce_id = $result->announce_id;
					$this->roadmap_id = $result->roadmap_id;
					$this->service_id = $result->service_id;
					$this->type_id = $result->type_id;
					
                    $entityType_id = tzSQL::getEntity('notifiaction_types');
                    $contentType_id =  $entityType_id->findManyBy('type_id',$result->type_id, 'no');
                    $this->notifiaction_types = $contentType_id;
                $this->create_at = $result->create_at;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM notifications WHERE notification_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->notification_id = $formatResult->notification_id;
					$this->project_id = $formatResult->project_id;
					$this->ticket_id = $formatResult->ticket_id;
					$this->user_creator_id = $formatResult->user_creator_id;
					$this->announce_id = $formatResult->announce_id;
					$this->roadmap_id = $formatResult->roadmap_id;
					$this->service_id = $formatResult->service_id;
					$this->type_id = $formatResult->type_id;
				
                    $entityType_id = tzSQL::getEntity('notifiaction_types');
                    $contentType_id =  $entityType_id->findManyBy('type_id',$formatResult->type_id, 'no');
                    $this->notifiaction_types = $contentType_id;
                	$this->create_at = $formatResult->create_at;
				
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}
			

			/************* FindManyBy(column, value) ***************/
			public function findManyBy($param,$value,$recursif = 'yes'){


				switch ($param){
					
					case $param == 'notification_id':
						$param = 'notification_id';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					case $param == 'user_creator_id':
						$param = 'user_creator_id';
						break;
						
					case $param == 'announce_id':
						$param = 'announce_id';
						break;
						
					case $param == 'roadmap_id':
						$param = 'roadmap_id';
						break;
						
					case $param == 'service_id':
						$param = 'service_id';
						break;
						
					case $param == 'type_id':
						$param = 'type_id';
						break;
						
					case $param == 'create_at':
						$param = 'create_at';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM notifications WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new notificationsEntity();

						foreach ($data as $k => $value) {

							$method = 'set'.ucfirst($k);
							$tmpInstance->$method($value);

                            if($recursif == 'yes'){
                                foreach($this->relations as $relationId => $relationLinks){
                                    if(array_key_exists($k, $relationLinks)){
                                        $entity = tzSQL::getEntity($relationId);
                                        $content =  $entity->findManyBy($relationLinks[$k],$value, 'no');
                                        $tmpInstance->$relationId = $content;
                                    }
                                }
                            }

						}
						array_push($entitiesArray, $tmpInstance);
					}

					if($entitiesArray)
						return $entitiesArray;
					else{
						DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
						return false;
					}

				}
			}

            public function getNotifications($project_id, $user_id){
                $sql = 'SELECT *
                        FROM `notifications`
                        LEFT JOIN `user_notification` ON `notifications`.`notification_id` = `user_notification`.`notification_id`
                        LEFT JOIN `notifiaction_types` ON `notifications`.`type_id` = `notifiaction_types`.`type_id`
                        LEFT JOIN `roadmaps` ON `roadmaps`.`roadmap_id` = `notifications`.`roadmap_id`
                        LEFT JOIN `announces` ON `announces`.`announce_id` = `notifications`.`announce_id`
                        LEFT JOIN `projects` ON `projects`.`project_id` = `notifications`.`project_id`
                        LEFT JOIN `services` ON `services`.`service_id` = `notifications`.`service_id`
                        LEFT JOIN `tickets` ON `tickets`.`ticket_id` = `notifications`.`ticket_id`
                        LEFT JOIN `users` ON `users`.`id` = `notifications`.`user_creator_id`
                        WHERE `notifications`.`project_id` = '.$project_id.'
                        AND `user_notification`.`user_id` = '.$user_id.'
                        AND `user_notification`.`notification_view` = 0
                        ORDER BY `notifications`.`notification_id` DESC';


                $pdo = TzSQL::getPDO();

                foreach  ($pdo->query($sql) as $row) {
                    $notifs[] = $row;
                }


                if (!isset($notifs))
                    return false;

                return $notifs;

            }

            public function getNotificationsByProject($project_id){
                $sql = 'SELECT *
                        FROM `notifications`
                        LEFT JOIN `user_notification` ON `notifications`.`notification_id` = `user_notification`.`notification_id`
                        LEFT JOIN `notifiaction_types` ON `notifications`.`type_id` = `notifiaction_types`.`type_id`
                        LEFT JOIN `roadmaps` ON `roadmaps`.`roadmap_id` = `notifications`.`roadmap_id`
                        LEFT JOIN `announces` ON `announces`.`announce_id` = `notifications`.`announce_id`
                        LEFT JOIN `projects` ON `projects`.`project_id` = `notifications`.`project_id`
                        LEFT JOIN `services` ON `services`.`service_id` = `notifications`.`service_id`
                        LEFT JOIN `tickets` ON `tickets`.`ticket_id` = `notifications`.`ticket_id`
                        LEFT JOIN `users` ON `users`.`id` = `notifications`.`user_creator_id`
                        WHERE `notifications`.`project_id` = '.$project_id.'
                        ORDER BY `notifications`.`notification_id` DESC';


                $pdo = TzSQL::getPDO();

                foreach  ($pdo->query($sql) as $key=>$row) {

                    $notifs[] = $row;

                    if ($row['announce_description']){
                        $notifs['announce_description'] = substr($row['announce_description'],0,100).'...';
                    }
                    elseif ($row['roadmap_description']){
                        $notifs['roadmap_description'] = substr($row['roadmap_description'],0,100).'...';
                    }
                    elseif ($row['ticket_description']){
                        $notifs['ticket_description'] = substr($row['ticket_description'],0,100).'...';
                    }

                    $user_id = (int) $row['user_id'];
                    $sql2 = 'SELECT *
                        FROM `users`
                        WHERE id = '.$user_id;
                    $o = TzSQL::getPDO();
                    $o->prepare($sql2);


                    foreach ($o->query($sql2) as $row){
                        if (isset($details))
                            break;

                        $detail = $row;
                    }
                    $notifs[$key]['user_dest'] = $detail;

                }


                if (!isset($notifs))
                    return false;

                return array_slice($notifs,0,10);

            }

            public function getNotificationsByUser($user_id){
                $sql = 'SELECT *
                        FROM `user_notification`
                        LEFT JOIN `notifications` ON `notifications`.`notification_id` = `user_notification`.`notification_id`
                        LEFT JOIN `notifiaction_types` ON `notifications`.`type_id` = `notifiaction_types`.`type_id`
                        LEFT JOIN `roadmaps` ON `roadmaps`.`roadmap_id` = `notifications`.`roadmap_id`
                        LEFT JOIN `announces` ON `announces`.`announce_id` = `notifications`.`announce_id`
                        LEFT JOIN `projects` ON `projects`.`project_id` = `notifications`.`project_id`
                        LEFT JOIN `services` ON `services`.`service_id` = `notifications`.`service_id`
                        LEFT JOIN `tickets` ON `tickets`.`ticket_id` = `notifications`.`ticket_id`
                        LEFT JOIN `users` ON `users`.`id` = `notifications`.`user_creator_id`
                        WHERE `user_notification`.`user_id` = '.$user_id.'
                        ORDER BY `notifications`.`notification_id` DESC';


                $pdo = TzSQL::getPDO();

                foreach  ($pdo->query($sql) as $key=>$row) {

                    $notifs[] = $row;

                    if ($row['announce_description']){
                        $notifs['announce_description'] = substr($row['announce_description'],0,100).'...';
                    }
                    elseif ($row['roadmap_description']){
                        $notifs['roadmap_description'] = substr($row['roadmap_description'],0,100).'...';
                    }
                    elseif ($row['ticket_description']){
                        $notifs['ticket_description'] = substr($row['ticket_description'],0,100).'...';
                    }

                    $user_id = (int) $row['user_id'];
                    $sql2 = 'SELECT *
                        FROM `users`
                        WHERE id = '.$user_id;
                    $o = TzSQL::getPDO();
                    $o->prepare($sql2);


                    foreach ($o->query($sql2) as $row){
                        if (isset($details))
                            break;

                        $detail = $row;
                    }
                    $notifs[$key]['user_dest'] = $detail;

                }


                if (!isset($notifs))
                    return false;

                return array_slice($notifs,0,10);

            }

            public function clearNotif($id_notif, $id_user){

                $sql = "UPDATE `user_notification` SET `notification_view` = 1 WHERE notification_id = ".$id_notif." AND user_id = ".$id_user;
                $pdo = TzSQL::getPDO();

                $pdo->prepare($sql)->execute();

                return true;

            }
					

		}

	?>
					