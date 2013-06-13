
	<?php

				

		class user_projectEntity {
					
			private $id;
			
			private $project_id;
			
			private $rights_key;
			


			/********************** GETTER ***********************/
			

			public function getId(){
				return $this->id;
			}

			

			public function getProject_id(){
				return $this->project_id;
			}

			

			public function getRights_key(){
				return $this->rights_key;
			}

			
			/********************** SETTER ***********************/

			public function setId($val){
				$this->id =  $val;
			}

					

			public function setProject_id($val){
				$this->project_id =  $val;
			}

					

			public function setRights_key($val){
				$this->rights_key =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->rights_key)){

					$sql = "DELETE FROM user_project WHERE rights_key = ".intval($this->rights_key).";";

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

				$sql = 'UPDATE `user_project` SET `id` = "'.$this->id.'", `project_id` = "'.$this->project_id.'", `rights_key` = "'.$this->rights_key.'" WHERE rights_key = '.intval($this->rights_key);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->rights_key)){
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

				$this->rights_key = '';

				$sql = 'INSERT INTO user_project (`id`,`project_id`,`rights_key`) VALUES ("'.$this->id.'","'.$this->project_id.'","'.$this->rights_key.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->rights_key = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM user_project';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new user_projectEntity();

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
					
					case $param == 'id':
						$param = 'id';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'rights_key':
						$param = 'rights_key';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM user_project WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->id = $result->id;
					$this->project_id = $result->project_id;
					$this->rights_key = $result->rights_key;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM user_project WHERE rights_key = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->id = $formatResult->id;
					$this->project_id = $formatResult->project_id;
					$this->rights_key = $formatResult->rights_key;
				
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
					
					case $param == 'id':
						$param = 'id';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'rights_key':
						$param = 'rights_key';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM user_project WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new user_projectEntity();

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
					