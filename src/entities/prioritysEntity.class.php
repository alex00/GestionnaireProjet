
	<?php

				

		class prioritysEntity {
					
			private $priority_id;
			
			private $priority_code;
			
			private $priority_name;
			
			private $priority_color;
			


			/********************** GETTER ***********************/
			

			public function getPriority_id(){
				return $this->priority_id;
			}

			

			public function getPriority_code(){
				return $this->priority_code;
			}

			

			public function getPriority_name(){
				return $this->priority_name;
			}

			

			public function getPriority_color(){
				return $this->priority_color;
			}

			
			/********************** SETTER ***********************/

			public function setPriority_id($val){
				$this->priority_id =  $val;
			}

					

			public function setPriority_code($val){
				$this->priority_code =  $val;
			}

					

			public function setPriority_name($val){
				$this->priority_name =  $val;
			}

					

			public function setPriority_color($val){
				$this->priority_color =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->priority_id)){

					$sql = "DELETE FROM prioritys WHERE priority_id = ".intval($this->priority_id).";";

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

				$sql = 'UPDATE `prioritys` SET `priority_id` = "'.$this->priority_id.'", `priority_code` = "'.$this->priority_code.'", `priority_name` = "'.$this->priority_name.'", `priority_color` = "'.$this->priority_color.'" WHERE priority_id = '.intval($this->priority_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->priority_id)){
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

				$this->priority_id = '';

				$sql = 'INSERT INTO prioritys (`priority_id`,`priority_code`,`priority_name`,`priority_color`) VALUES ("'.$this->priority_id.'","'.$this->priority_code.'","'.$this->priority_name.'","'.$this->priority_color.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->priority_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM prioritys';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new prioritysEntity();

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
					
					case $param == 'priority_id':
						$param = 'priority_id';
						break;
						
					case $param == 'priority_code':
						$param = 'priority_code';
						break;
						
					case $param == 'priority_name':
						$param = 'priority_name';
						break;
						
					case $param == 'priority_color':
						$param = 'priority_color';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM prioritys WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->priority_id = $result->priority_id;
					$this->priority_code = $result->priority_code;
					$this->priority_name = $result->priority_name;
					$this->priority_color = $result->priority_color;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM prioritys WHERE priority_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->priority_id = $formatResult->priority_id;
					$this->priority_code = $formatResult->priority_code;
					$this->priority_name = $formatResult->priority_name;
					$this->priority_color = $formatResult->priority_color;
				
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
					
					case $param == 'priority_id':
						$param = 'priority_id';
						break;
						
					case $param == 'priority_code':
						$param = 'priority_code';
						break;
						
					case $param == 'priority_name':
						$param = 'priority_name';
						break;
						
					case $param == 'priority_color':
						$param = 'priority_color';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM prioritys WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new prioritysEntity();

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
					