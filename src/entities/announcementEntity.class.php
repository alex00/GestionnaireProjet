
	<?php

				

		class announcementEntity {
					
			private $idannouncement;
			
			private $announcement_title;
			
			private $announcement_description;
			
			private $announcement_date_create;
			
			private $announcement_date_update;
			
			private $project_id;
			


			/********************** GETTER ***********************/
			

			public function getIdannouncement(){
				return $this->idannouncement;
			}

			

			public function getAnnouncement_title(){
				return $this->announcement_title;
			}

			

			public function getAnnouncement_description(){
				return $this->announcement_description;
			}

			

			public function getAnnouncement_date_create(){
				return $this->announcement_date_create;
			}

			

			public function getAnnouncement_date_update(){
				return $this->announcement_date_update;
			}

			

			public function getProject_id(){
				return $this->project_id;
			}

			
			/********************** SETTER ***********************/

			public function setIdannouncement($val){
				$this->idannouncement =  $val;
			}

					

			public function setAnnouncement_title($val){
				$this->announcement_title =  $val;
			}

					

			public function setAnnouncement_description($val){
				$this->announcement_description =  $val;
			}

					

			public function setAnnouncement_date_create($val){
				$this->announcement_date_create =  $val;
			}

					

			public function setAnnouncement_date_update($val){
				$this->announcement_date_update =  $val;
			}

					

			public function setProject_id($val){
				$this->project_id =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->idannouncement)){

					$sql = "DELETE FROM announcement WHERE idannouncement = ".intval($this->idannouncement).";";

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

				$sql = 'UPDATE `announcement` SET `idannouncement` = "'.$this->idannouncement.'", `announcement_title` = "'.$this->announcement_title.'", `announcement_description` = "'.$this->announcement_description.'", `announcement_date_create` = "'.$this->announcement_date_create.'", `announcement_date_update` = "'.$this->announcement_date_update.'", `project_id` = "'.$this->project_id.'" WHERE idannouncement = '.intval($this->idannouncement);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->idannouncement)){
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

				$this->idannouncement = '';

				$sql = 'INSERT INTO announcement (`idannouncement`,`announcement_title`,`announcement_description`,`announcement_date_create`,`announcement_date_update`,`project_id`) VALUES ("'.$this->idannouncement.'","'.$this->announcement_title.'","'.$this->announcement_description.'","'.$this->announcement_date_create.'","'.$this->announcement_date_update.'","'.$this->project_id.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->idannouncement = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM announcement';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new announcementEntity();

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
					
					case $param == 'idannouncement':
						$param = 'idannouncement';
						break;
						
					case $param == 'announcement_title':
						$param = 'announcement_title';
						break;
						
					case $param == 'announcement_description':
						$param = 'announcement_description';
						break;
						
					case $param == 'announcement_date_create':
						$param = 'announcement_date_create';
						break;
						
					case $param == 'announcement_date_update':
						$param = 'announcement_date_update';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM announcement WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->idannouncement = $result->idannouncement;
					$this->announcement_title = $result->announcement_title;
					$this->announcement_description = $result->announcement_description;
					$this->announcement_date_create = $result->announcement_date_create;
					$this->announcement_date_update = $result->announcement_date_update;
					$this->project_id = $result->project_id;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM announcement WHERE idannouncement = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->idannouncement = $formatResult->idannouncement;
					$this->announcement_title = $formatResult->announcement_title;
					$this->announcement_description = $formatResult->announcement_description;
					$this->announcement_date_create = $formatResult->announcement_date_create;
					$this->announcement_date_update = $formatResult->announcement_date_update;
					$this->project_id = $formatResult->project_id;
				
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
					
					case $param == 'idannouncement':
						$param = 'idannouncement';
						break;
						
					case $param == 'announcement_title':
						$param = 'announcement_title';
						break;
						
					case $param == 'announcement_description':
						$param = 'announcement_description';
						break;
						
					case $param == 'announcement_date_create':
						$param = 'announcement_date_create';
						break;
						
					case $param == 'announcement_date_update':
						$param = 'announcement_date_update';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM announcement WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new announcementEntity();

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
					