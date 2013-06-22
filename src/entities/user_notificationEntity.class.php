<?php
		use Components\SQLEntities\TzSQL;
		use Components\DebugTools\DebugTool;

		class user_notificationEntity {
					
			private $notification_id;
			
			private $user_id;
			
			private $notification_view;
			
            private $relations = array('notifications'=>array('notification_id'=>'notification_id'),'users'=>array('user_id'=>'id'),);
        
            private $notifications;
            
            private $users;
            



			/********************** GETTER ***********************/
			

			public function getNotification_id(){
				return $this->notification_id;
			}

			

			public function getUser_id(){
				return $this->user_id;
			}

			

			public function getNotification_view(){
				return $this->notification_view;
			}

			
			/********************** SETTER ***********************/

			public function setNotification_id($val){
				$this->notification_id =  $val;
			}

					

			public function setUser_id($val){
				$this->user_id =  $val;
			}

					

			public function setNotification_view($val){
				$this->notification_view =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->user_id)){

					$sql = "DELETE FROM user_notification WHERE user_id = ".intval($this->user_id).";";

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

				$sql = 'UPDATE `user_notification` SET `notification_id` = "'.$this->notification_id.'", `user_id` = "'.$this->user_id.'", `notification_view` = "'.$this->notification_view.'" WHERE user_id = '.intval($this->user_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->user_id)){
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

				$this->user_id = '';

				$sql = 'INSERT INTO user_notification (`notification_id`,`user_id`,`notification_view`) VALUES ("'.$this->notification_id.'","'.$this->user_id.'","'.$this->notification_view.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->user_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll($recursif = 'yes'){

				$sql = 'SELECT * FROM user_notification';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new user_notificationEntity();

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
						
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					case $param == 'notification_view':
						$param = 'notification_view';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM user_notification WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->notification_id = $result->notification_id;
					
                    $entityNotification_id = tzSQL::getEntity('notifications');
                    $contentNotification_id =  $entityNotification_id->findManyBy('notification_id',$result->notification_id, 'no');
                    $this->notifications = $contentNotification_id;
                $this->user_id = $result->user_id;
					
                    $entityUser_id = tzSQL::getEntity('users');
                    $contentUser_id =  $entityUser_id->findManyBy('id',$result->user_id, 'no');
                    $this->users = $contentUser_id;
                $this->notification_view = $result->notification_view;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM user_notification WHERE user_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->notification_id = $formatResult->notification_id;
				
                    $entityNotification_id = tzSQL::getEntity('notifications');
                    $contentNotification_id =  $entityNotification_id->findManyBy('notification_id',$formatResult->notification_id, 'no');
                    $this->notifications = $contentNotification_id;
                	$this->user_id = $formatResult->user_id;
				
                    $entityUser_id = tzSQL::getEntity('users');
                    $contentUser_id =  $entityUser_id->findManyBy('id',$formatResult->user_id, 'no');
                    $this->users = $contentUser_id;
                	$this->notification_view = $formatResult->notification_view;
				
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
						
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					case $param == 'notification_view':
						$param = 'notification_view';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM user_notification WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new user_notificationEntity();

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

					

		}

	?>
					