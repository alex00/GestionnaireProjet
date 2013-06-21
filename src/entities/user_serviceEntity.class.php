
	<?php

				

		class user_serviceEntity {
					
			private $user_id;
			
			private $service_id;
			
			private $project_id;
			
			private $rightKey;
			


			/********************** GETTER ***********************/
			

			public function getUser_id(){
				return $this->user_id;
			}

			

			public function getService_id(){
				return $this->service_id;
			}

			

			public function getProject_id(){
				return $this->project_id;
			}

			

			public function getRightKey(){
				return $this->rightKey;
			}

			
			/********************** SETTER ***********************/

			public function setUser_id($val){
				$this->user_id =  $val;
			}

					

			public function setService_id($val){
				$this->service_id =  $val;
			}

					

			public function setProject_id($val){
				$this->project_id =  $val;
			}

					

			public function setRightKey($val){
				$this->rightKey =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->project_id)){

					$sql = "DELETE FROM user_service WHERE project_id = ".intval($this->project_id).";";

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

				$sql = 'UPDATE `user_service` SET `user_id` = "'.$this->user_id.'", `service_id` = "'.$this->service_id.'", `project_id` = "'.$this->project_id.'", `rightKey` = "'.$this->rightKey.'" WHERE project_id = '.intval($this->project_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->project_id)){
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

				$this->project_id = '';

				$sql = 'INSERT INTO user_service (`user_id`,`service_id`,`project_id`,`rightKey`) VALUES ("'.$this->user_id.'","'.$this->service_id.'","'.$this->project_id.'","'.$this->rightKey.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->project_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM user_service';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new user_serviceEntity();

					foreach ($data as $k => $value) {

						$method = 'set'.ucfirst($k);
						$tmpInstance->$method($value);
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
					
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					case $param == 'service_id':
						$param = 'service_id';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'rightKey':
						$param = 'rightKey';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM user_service WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->user_id = $result->user_id;
					$this->service_id = $result->service_id;
					$this->project_id = $result->project_id;
					$this->rightKey = $result->rightKey;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM user_service WHERE project_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->user_id = $formatResult->user_id;
					$this->service_id = $formatResult->service_id;
					$this->project_id = $formatResult->project_id;
					$this->rightKey = $formatResult->rightKey;
				
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}
			

			/************* FindManyBy(column, value) ***************/
			public function findManyBy($param,$value){


				switch ($param){
					
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					case $param == 'service_id':
						$param = 'service_id';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'rightKey':
						$param = 'rightKey';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM user_service WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new user_serviceEntity();

						foreach ($data as $k => $value) {

							$method = 'set'.ucfirst($k);
							$tmpInstance->$method($value);
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
					