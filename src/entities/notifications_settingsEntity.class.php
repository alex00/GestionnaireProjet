<?php
		use Components\SQLEntities\TzSQL;
		use Components\DebugTools\DebugTool;

		class notifications_settingsEntity {
					
			private $notifiaction_id;
			
			private $users_id;
			
			private $notifications_settings;
			
            private $relations = array('notifiaction_types'=>array('notifiaction_id'=>'type_id'),'users'=>array('users_id'=>'id'),);
        
            private $notifiaction_types;
            
            private $users;
            



			/********************** GETTER ***********************/
			

			public function getNotifiaction_id(){
				return $this->notifiaction_id;
			}

			

			public function getUsers_id(){
				return $this->users_id;
			}

			

			public function getNotifications_settings(){
				return $this->notifications_settings;
			}

			
			/********************** SETTER ***********************/

			public function setNotifiaction_id($val){
				$this->notifiaction_id =  $val;
			}

					

			public function setUsers_id($val){
				$this->users_id =  $val;
			}

					

			public function setNotifications_settings($val){
				$this->notifications_settings =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->users_id)){

					$sql = "DELETE FROM notifications_settings WHERE users_id = ".intval($this->users_id).";";

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

				$sql = 'UPDATE `notifications_settings` SET `notifiaction_id` = "'.$this->notifiaction_id.'", `users_id` = "'.$this->users_id.'", `notifications_settings` = "'.$this->notifications_settings.'" WHERE users_id = '.intval($this->users_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->users_id)){
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

				$this->users_id = '';

				$sql = 'INSERT INTO notifications_settings (`notifiaction_id`,`users_id`,`notifications_settings`) VALUES ("'.$this->notifiaction_id.'","'.$this->users_id.'","'.$this->notifications_settings.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->users_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll($recursif = 'yes'){

				$sql = 'SELECT * FROM notifications_settings';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new notifications_settingsEntity();

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
					
					case $param == 'notifiaction_id':
						$param = 'notifiaction_id';
						break;
						
					case $param == 'users_id':
						$param = 'users_id';
						break;
						
					case $param == 'notifications_settings':
						$param = 'notifications_settings';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM notifications_settings WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->notifiaction_id = $result->notifiaction_id;
					
                    $entityNotifiaction_id = tzSQL::getEntity('notifiaction_types');
                    $contentNotifiaction_id =  $entityNotifiaction_id->findManyBy('type_id',$result->notifiaction_id, 'no');
                    $this->notifiaction_types = $contentNotifiaction_id;
                $this->users_id = $result->users_id;
					
                    $entityUsers_id = tzSQL::getEntity('users');
                    $contentUsers_id =  $entityUsers_id->findManyBy('id',$result->users_id, 'no');
                    $this->users = $contentUsers_id;
                $this->notifications_settings = $result->notifications_settings;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM notifications_settings WHERE users_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->notifiaction_id = $formatResult->notifiaction_id;
				
                    $entityNotifiaction_id = tzSQL::getEntity('notifiaction_types');
                    $contentNotifiaction_id =  $entityNotifiaction_id->findManyBy('type_id',$formatResult->notifiaction_id, 'no');
                    $this->notifiaction_types = $contentNotifiaction_id;
                	$this->users_id = $formatResult->users_id;
				
                    $entityUsers_id = tzSQL::getEntity('users');
                    $contentUsers_id =  $entityUsers_id->findManyBy('id',$formatResult->users_id, 'no');
                    $this->users = $contentUsers_id;
                	$this->notifications_settings = $formatResult->notifications_settings;
				
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
					
					case $param == 'notifiaction_id':
						$param = 'notifiaction_id';
						break;
						
					case $param == 'users_id':
						$param = 'users_id';
						break;
						
					case $param == 'notifications_settings':
						$param = 'notifications_settings';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM notifications_settings WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new notifications_settingsEntity();

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
					