
	<?php

				

		class projectsEntity {
					
			private $project_id;
			
			private $project_name;
			
			private $project_date_create;
			
			private $project_date_update;
			
			private $project_code;
			
			private $project_description;
			


			/********************** GETTER ***********************/
			

			public function getProject_id(){
				return $this->project_id;
			}

			

			public function getProject_name(){
				return $this->project_name;
			}

			

			public function getProject_date_create(){
				return $this->project_date_create;
			}

			

			public function getProject_date_update(){
				return $this->project_date_update;
			}

			

			public function getProject_code(){
				return $this->project_code;
			}

			

			public function getProject_description(){
				return $this->project_description;
			}

			
			/********************** SETTER ***********************/

			public function setProject_id($val){
				$this->project_id =  $val;
			}

					

			public function setProject_name($val){
				$this->project_name =  $val;
			}

					

			public function setProject_date_create($val){
				$this->project_date_create =  $val;
			}

					

			public function setProject_date_update($val){
				$this->project_date_update =  $val;
			}

					

			public function setProject_code($val){
				$this->project_code =  $val;
			}

					

			public function setProject_description($val){
				$this->project_description =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->project_id)){

					$sql = "DELETE FROM projects WHERE project_id = ".intval($this->project_id).";";

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

				$sql = 'UPDATE `projects` SET `project_id` = "'.$this->project_id.'", `project_name` = "'.$this->project_name.'", `project_date_create` = "'.$this->project_date_create.'", `project_date_update` = "'.$this->project_date_update.'", `project_code` = "'.$this->project_code.'", `project_description` = "'.$this->project_description.'" WHERE project_id = '.intval($this->project_id);

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

				$sql = 'INSERT INTO projects (`project_id`,`project_name`,`project_date_create`,`project_date_update`,`project_code`,`project_description`) VALUES ("'.$this->project_id.'","'.$this->project_name.'","'.$this->project_date_create.'","'.$this->project_date_update.'","'.$this->project_code.'","'.$this->project_description.'")';

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

				$sql = 'SELECT * FROM projects';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new projectsEntity();

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
					
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'project_name':
						$param = 'project_name';
						break;
						
					case $param == 'project_date_create':
						$param = 'project_date_create';
						break;
						
					case $param == 'project_date_update':
						$param = 'project_date_update';
						break;
						
					case $param == 'project_code':
						$param = 'project_code';
						break;
						
					case $param == 'project_description':
						$param = 'project_description';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM projects WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->project_id = $result->project_id;
					$this->project_name = $result->project_name;
					$this->project_date_create = $result->project_date_create;
					$this->project_date_update = $result->project_date_update;
					$this->project_code = $result->project_code;
					$this->project_description = $result->project_description;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM projects WHERE project_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->project_id = $formatResult->project_id;
					$this->project_name = $formatResult->project_name;
					$this->project_date_create = $formatResult->project_date_create;
					$this->project_date_update = $formatResult->project_date_update;
					$this->project_code = $formatResult->project_code;
					$this->project_description = $formatResult->project_description;
				
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
					
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'project_name':
						$param = 'project_name';
						break;
						
					case $param == 'project_date_create':
						$param = 'project_date_create';
						break;
						
					case $param == 'project_date_update':
						$param = 'project_date_update';
						break;
						
					case $param == 'project_code':
						$param = 'project_code';
						break;
						
					case $param == 'project_description':
						$param = 'project_description';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM projects WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new projectsEntity();

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
					