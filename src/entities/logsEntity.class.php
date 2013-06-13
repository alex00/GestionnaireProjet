
	<?php

				

		class logsEntity {
					
			private $logs_key;
			
			private $logs_value;
			
			private $logs_date;
			


			/********************** GETTER ***********************/
			

			public function getLogs_key(){
				return $this->logs_key;
			}

			

			public function getLogs_value(){
				return $this->logs_value;
			}

			

			public function getLogs_date(){
				return $this->logs_date;
			}

			
			/********************** SETTER ***********************/

			public function setLogs_key($val){
				$this->logs_key =  $val;
			}

					

			public function setLogs_value($val){
				$this->logs_value =  $val;
			}

					

			public function setLogs_date($val){
				$this->logs_date =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->logs_key)){

					$sql = "DELETE FROM logs WHERE logs_key = ".intval($this->logs_key).";";

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

				$sql = 'UPDATE `logs` SET `logs_key` = "'.$this->logs_key.'", `logs_value` = "'.$this->logs_value.'", `logs_date` = "'.$this->logs_date.'" WHERE logs_key = '.intval($this->logs_key);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->logs_key)){
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

				$this->logs_key = '';

				$sql = 'INSERT INTO logs (`logs_key`,`logs_value`,`logs_date`) VALUES ("'.$this->logs_key.'","'.$this->logs_value.'","'.$this->logs_date.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->logs_key = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM logs';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new logsEntity();

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
					
					case $param == 'logs_key':
						$param = 'logs_key';
						break;
						
					case $param == 'logs_value':
						$param = 'logs_value';
						break;
						
					case $param == 'logs_date':
						$param = 'logs_date';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM logs WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->logs_key = $result->logs_key;
					$this->logs_value = $result->logs_value;
					$this->logs_date = $result->logs_date;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM logs WHERE logs_key = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->logs_key = $formatResult->logs_key;
					$this->logs_value = $formatResult->logs_value;
					$this->logs_date = $formatResult->logs_date;
				
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
					
					case $param == 'logs_key':
						$param = 'logs_key';
						break;
						
					case $param == 'logs_value':
						$param = 'logs_value';
						break;
						
					case $param == 'logs_date':
						$param = 'logs_date';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM logs WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new logsEntity();

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
					