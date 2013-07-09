<?php
		use Components\SQLEntities\TzSQL;
		use Components\DebugTools\DebugTool;

		class usersEntity {
					
			private $id;
			
			private $user_mail;
			
			private $password;
			
			private $user_login;
			
			private $user_login_code;
			
			private $user_date_create;
			
			private $acl_group_id;
                        
                        private  $user_notification_mail;


                        private $relations = array();
        



			/********************** GETTER ***********************/
			

			public function getId(){
				return $this->id;
			}

			

			public function getUser_mail(){
				return $this->user_mail;
			}

			

			public function getPassword(){
				return $this->password;
			}

			

			public function getUser_login(){
				return $this->user_login;
			}

			

			public function getUser_login_code(){
				return $this->user_login_code;
			}

			

			public function getUser_date_create(){
				return $this->user_date_create;
			}

			

			public function getAcl_group_id(){
				return $this->acl_group_id;
			}
                        
                         public function getUser_notification_mail(){
				return $this->rightKey;
			}

			
			/********************** SETTER ***********************/

			public function setId($val){
				$this->id =  $val;
			}

					

			public function setUser_mail($val){
				$this->user_mail =  $val;
			}

					

			public function setPassword($val){
				$this->password =  $val;
			}

					

			public function setUser_login($val){
				$this->user_login =  $val;
			}

					

			public function setUser_login_code($val){
				$this->user_login_code =  $val;
			}

					

			public function setUser_date_create($val){
				$this->user_date_create =  $val;
			}

					

			public function setAcl_group_id($val){
				$this->acl_group_id =  $val;
			}
                        
                        public function setUser_notification_mail($val){
                            $this->user_notification_mail =  $val;
                        }

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->id)){

					$sql = "DELETE FROM users WHERE id = ".intval($this->id).";";

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

				$sql = 'UPDATE `users` SET `id` = "'.$this->id.'", `user_mail` = "'.$this->user_mail.'", `password` = "'.$this->password.'", `user_login` = "'.$this->user_login.'", `user_login_code` = "'.$this->user_login_code.'", `user_date_create` = "'.$this->user_date_create.'", `acl_group_id` = "'.$this->acl_group_id.'" WHERE id = '.intval($this->id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->id)){
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

				$this->id = '';

				$sql = 'INSERT INTO users (`id`,`user_mail`,`password`,`user_login`,`user_login_code`,`user_date_create`,`acl_group_id`) VALUES ("'.$this->id.'","'.$this->user_mail.'","'.$this->password.'","'.$this->user_login.'","'.$this->user_login_code.'","'.$this->user_date_create.'","'.$this->acl_group_id.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll($recursif = 'yes'){

				$sql = 'SELECT * FROM users';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new usersEntity();

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
					
					case $param == 'id':
						$param = 'id';
						break;
						
					case $param == 'user_mail':
						$param = 'user_mail';
						break;
						
					case $param == 'password':
						$param = 'password';
						break;
						
					case $param == 'user_login':
						$param = 'user_login';
						break;
						
					case $param == 'user_login_code':
						$param = 'user_login_code';
						break;
						
					case $param == 'user_date_create':
						$param = 'user_date_create';
						break;
						
					case $param == 'acl_group_id':
						$param = 'acl_group_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM users WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->id = $result->id;
					$this->user_mail = $result->user_mail;
					$this->password = $result->password;
					$this->user_login = $result->user_login;
					$this->user_login_code = $result->user_login_code;
					$this->user_date_create = $result->user_date_create;
					$this->acl_group_id = $result->acl_group_id;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM users WHERE id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->id = $formatResult->id;
					$this->user_mail = $formatResult->user_mail;
					$this->password = $formatResult->password;
					$this->user_login = $formatResult->user_login;
					$this->user_login_code = $formatResult->user_login_code;
					$this->user_date_create = $formatResult->user_date_create;
					$this->acl_group_id = $formatResult->acl_group_id;
				
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
					
					case $param == 'id':
						$param = 'id';
						break;
						
					case $param == 'user_mail':
						$param = 'user_mail';
						break;
						
					case $param == 'password':
						$param = 'password';
						break;
						
					case $param == 'user_login':
						$param = 'user_login';
						break;
						
					case $param == 'user_login_code':
						$param = 'user_login_code';
						break;
						
					case $param == 'user_date_create':
						$param = 'user_date_create';
						break;
						
					case $param == 'acl_group_id':
						$param = 'acl_group_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM users WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new usersEntity();

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
                        
                        public function allMembersProject($id_project){
                            
                            $sql =  'SELECT users.id as user_id FROM users, user_service
                                    WHERE users.id = user_service.user_id 
                                    AND user_service.project_id = '.$id_project;
                            $data = TzSQL::getPDO()->prepare($sql);
                            $data->execute();
                            $formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
                            
                            $entitiesArray = array();
                            $usersArray = array();
                            
                            
                            
                            $sql2 = 'SELECT * FROM users';
                            $data2 = TzSQL::getPDO()->prepare($sql2);
                            $data2->execute();
                            $formatResult2 = $data2->fetchAll(PDO::FETCH_ASSOC);
                            
                                                    
                            foreach ($formatResult as $value) {
                                array_push($entitiesArray, $value['user_id']);
                            }
                            
                            foreach ($formatResult2 as $value2) {
                                if(!in_array($value2['id'], $entitiesArray)){
                                    array_push($usersArray, $value2);
                                }
                            }
                            
                            return $usersArray;
                        }
                        
                        
		}

					