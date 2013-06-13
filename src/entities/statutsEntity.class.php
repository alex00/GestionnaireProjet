
	<?php

				

		class statutsEntity {
					
			private $statut_id;
			
			private $statut_name;
			
			private $statut_code;
			


			/********************** GETTER ***********************/
			

			public function getStatut_id(){
				return $this->statut_id;
			}

			

			public function getStatut_name(){
				return $this->statut_name;
			}

			

			public function getStatut_code(){
				return $this->statut_code;
			}

			
			/********************** SETTER ***********************/

			public function setStatut_id($val){
				$this->statut_id =  $val;
			}

					

			public function setStatut_name($val){
				$this->statut_name =  $val;
			}

					

			public function setStatut_code($val){
				$this->statut_code =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->statut_id)){

					$sql = "DELETE FROM statuts WHERE statut_id = ".intval($this->statut_id).";";

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

				$sql = 'UPDATE `statuts` SET `statut_id` = "'.$this->statut_id.'", `statut_name` = "'.$this->statut_name.'", `statut_code` = "'.$this->statut_code.'" WHERE statut_id = '.intval($this->statut_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->statut_id)){
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

				$this->statut_id = '';

				$sql = 'INSERT INTO statuts (`statut_id`,`statut_name`,`statut_code`) VALUES ("'.$this->statut_id.'","'.$this->statut_name.'","'.$this->statut_code.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->statut_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM statuts';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new statutsEntity();

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
					
					case $param == 'statut_id':
						$param = 'statut_id';
						break;
						
					case $param == 'statut_name':
						$param = 'statut_name';
						break;
						
					case $param == 'statut_code':
						$param = 'statut_code';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM statuts WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->statut_id = $result->statut_id;
					$this->statut_name = $result->statut_name;
					$this->statut_code = $result->statut_code;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM statuts WHERE statut_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->statut_id = $formatResult->statut_id;
					$this->statut_name = $formatResult->statut_name;
					$this->statut_code = $formatResult->statut_code;
				
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
					
					case $param == 'statut_id':
						$param = 'statut_id';
						break;
						
					case $param == 'statut_name':
						$param = 'statut_name';
						break;
						
					case $param == 'statut_code':
						$param = 'statut_code';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM statuts WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new statutsEntity();

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
					