
	<?php

				

		class ticket_filesEntity {
					
			private $ticket_file_id;
			
			private $file_url;
			
			private $ticket_id;
			


			/********************** GETTER ***********************/
			

			public function getTicket_file_id(){
				return $this->ticket_file_id;
			}

			

			public function getFile_url(){
				return $this->file_url;
			}

			

			public function getTicket_id(){
				return $this->ticket_id;
			}

			
			/********************** SETTER ***********************/

			public function setTicket_file_id($val){
				$this->ticket_file_id =  $val;
			}

					

			public function setFile_url($val){
				$this->file_url =  $val;
			}

					

			public function setTicket_id($val){
				$this->ticket_id =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->ticket_file_id)){

					$sql = "DELETE FROM ticket_files WHERE ticket_file_id = ".intval($this->ticket_file_id).";";

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

				$sql = 'UPDATE `ticket_files` SET `ticket_file_id` = "'.$this->ticket_file_id.'", `file_url` = "'.$this->file_url.'", `ticket_id` = "'.$this->ticket_id.'" WHERE ticket_file_id = '.intval($this->ticket_file_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->ticket_file_id)){
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

				$this->ticket_file_id = '';

				$sql = 'INSERT INTO ticket_files (`ticket_file_id`,`file_url`,`ticket_id`) VALUES ("'.$this->ticket_file_id.'","'.$this->file_url.'","'.$this->ticket_id.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->ticket_file_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM ticket_files';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new ticket_filesEntity();

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
					
					case $param == 'ticket_file_id':
						$param = 'ticket_file_id';
						break;
						
					case $param == 'file_url':
						$param = 'file_url';
						break;
						
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM ticket_files WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->ticket_file_id = $result->ticket_file_id;
					$this->file_url = $result->file_url;
					$this->ticket_id = $result->ticket_id;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM ticket_files WHERE ticket_file_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->ticket_file_id = $formatResult->ticket_file_id;
					$this->file_url = $formatResult->file_url;
					$this->ticket_id = $formatResult->ticket_id;
				
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
					
					case $param == 'ticket_file_id':
						$param = 'ticket_file_id';
						break;
						
					case $param == 'file_url':
						$param = 'file_url';
						break;
						
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM ticket_files WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new ticket_filesEntity();

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
					