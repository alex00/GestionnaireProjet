
	<?php

				

		class trackersEntity {
					
			private $tracker_id;
			
			private $tracker_name;
			
			private $tracker_code;
			


			/********************** GETTER ***********************/
			

			public function getTracker_id(){
				return $this->tracker_id;
			}

			

			public function getTracker_name(){
				return $this->tracker_name;
			}

			

			public function getTracker_code(){
				return $this->tracker_code;
			}

			
			/********************** SETTER ***********************/

			public function setTracker_id($val){
				$this->tracker_id =  $val;
			}

					

			public function setTracker_name($val){
				$this->tracker_name =  $val;
			}

					

			public function setTracker_code($val){
				$this->tracker_code =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->tracker_id)){

					$sql = "DELETE FROM trackers WHERE tracker_id = ".intval($this->tracker_id).";";

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

				$sql = 'UPDATE `trackers` SET `tracker_id` = "'.$this->tracker_id.'", `tracker_name` = "'.$this->tracker_name.'", `tracker_code` = "'.$this->tracker_code.'" WHERE tracker_id = '.intval($this->tracker_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->tracker_id)){
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

				$this->tracker_id = '';

				$sql = 'INSERT INTO trackers (`tracker_id`,`tracker_name`,`tracker_code`) VALUES ("'.$this->tracker_id.'","'.$this->tracker_name.'","'.$this->tracker_code.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->tracker_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM trackers';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new trackersEntity();

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
					
					case $param == 'tracker_id':
						$param = 'tracker_id';
						break;
						
					case $param == 'tracker_name':
						$param = 'tracker_name';
						break;
						
					case $param == 'tracker_code':
						$param = 'tracker_code';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM trackers WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->tracker_id = $result->tracker_id;
					$this->tracker_name = $result->tracker_name;
					$this->tracker_code = $result->tracker_code;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM trackers WHERE tracker_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->tracker_id = $formatResult->tracker_id;
					$this->tracker_name = $formatResult->tracker_name;
					$this->tracker_code = $formatResult->tracker_code;
				
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
					
					case $param == 'tracker_id':
						$param = 'tracker_id';
						break;
						
					case $param == 'tracker_name':
						$param = 'tracker_name';
						break;
						
					case $param == 'tracker_code':
						$param = 'tracker_code';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM trackers WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new trackersEntity();

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
					