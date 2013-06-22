<?php
		use Components\SQLEntities\TzSQL;
		use Components\DebugTools\DebugTool;

		class roadmapsEntity {
					
			private $roadmap_id;
			
			private $project_id;
			
			private $roadmap_title;
			
			private $roadmap_code;
			
			private $roadmap_date_create;
			
			private $roadmap_date_update;
			
			private $roadmap_description;
			
            private $relations = array();
        



			/********************** GETTER ***********************/
			

			public function getRoadmap_id(){
				return $this->roadmap_id;
			}

			

			public function getProject_id(){
				return $this->project_id;
			}

			

			public function getRoadmap_title(){
				return $this->roadmap_title;
			}

			

			public function getRoadmap_code(){
				return $this->roadmap_code;
			}

			

			public function getRoadmap_date_create(){
				return $this->roadmap_date_create;
			}

			

			public function getRoadmap_date_update(){
				return $this->roadmap_date_update;
			}

			

			public function getRoadmap_description(){
				return $this->roadmap_description;
			}

			
			/********************** SETTER ***********************/

			public function setRoadmap_id($val){
				$this->roadmap_id =  $val;
			}

					

			public function setProject_id($val){
				$this->project_id =  $val;
			}

					

			public function setRoadmap_title($val){
				$this->roadmap_title =  $val;
			}

					

			public function setRoadmap_code($val){
				$this->roadmap_code =  $val;
			}

					

			public function setRoadmap_date_create($val){
				$this->roadmap_date_create =  $val;
			}

					

			public function setRoadmap_date_update($val){
				$this->roadmap_date_update =  $val;
			}

					

			public function setRoadmap_description($val){
				$this->roadmap_description =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->roadmap_id)){

					$sql = "DELETE FROM roadmaps WHERE roadmap_id = ".intval($this->roadmap_id).";";

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

				$sql = 'UPDATE `roadmaps` SET `roadmap_id` = "'.$this->roadmap_id.'", `project_id` = "'.$this->project_id.'", `roadmap_title` = "'.$this->roadmap_title.'", `roadmap_code` = "'.$this->roadmap_code.'", `roadmap_date_create` = "'.$this->roadmap_date_create.'", `roadmap_date_update` = "'.$this->roadmap_date_update.'", `roadmap_description` = "'.$this->roadmap_description.'" WHERE roadmap_id = '.intval($this->roadmap_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->roadmap_id)){
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

				$this->roadmap_id = '';

				$sql = 'INSERT INTO roadmaps (`roadmap_id`,`project_id`,`roadmap_title`,`roadmap_code`,`roadmap_date_create`,`roadmap_date_update`,`roadmap_description`) VALUES ("'.$this->roadmap_id.'","'.$this->project_id.'","'.$this->roadmap_title.'","'.$this->roadmap_code.'","'.$this->roadmap_date_create.'","'.$this->roadmap_date_update.'","'.$this->roadmap_description.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->roadmap_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll($recursif = 'yes'){

				$sql = 'SELECT * FROM roadmaps';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new roadmapsEntity();

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
					
					case $param == 'roadmap_id':
						$param = 'roadmap_id';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'roadmap_title':
						$param = 'roadmap_title';
						break;
						
					case $param == 'roadmap_code':
						$param = 'roadmap_code';
						break;
						
					case $param == 'roadmap_date_create':
						$param = 'roadmap_date_create';
						break;
						
					case $param == 'roadmap_date_update':
						$param = 'roadmap_date_update';
						break;
						
					case $param == 'roadmap_description':
						$param = 'roadmap_description';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM roadmaps WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->roadmap_id = $result->roadmap_id;
					$this->project_id = $result->project_id;
					$this->roadmap_title = $result->roadmap_title;
					$this->roadmap_code = $result->roadmap_code;
					$this->roadmap_date_create = $result->roadmap_date_create;
					$this->roadmap_date_update = $result->roadmap_date_update;
					$this->roadmap_description = $result->roadmap_description;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM roadmaps WHERE roadmap_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->roadmap_id = $formatResult->roadmap_id;
					$this->project_id = $formatResult->project_id;
					$this->roadmap_title = $formatResult->roadmap_title;
					$this->roadmap_code = $formatResult->roadmap_code;
					$this->roadmap_date_create = $formatResult->roadmap_date_create;
					$this->roadmap_date_update = $formatResult->roadmap_date_update;
					$this->roadmap_description = $formatResult->roadmap_description;
				
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
					
					case $param == 'roadmap_id':
						$param = 'roadmap_id';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'roadmap_title':
						$param = 'roadmap_title';
						break;
						
					case $param == 'roadmap_code':
						$param = 'roadmap_code';
						break;
						
					case $param == 'roadmap_date_create':
						$param = 'roadmap_date_create';
						break;
						
					case $param == 'roadmap_date_update':
						$param = 'roadmap_date_update';
						break;
						
					case $param == 'roadmap_description':
						$param = 'roadmap_description';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM roadmaps WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new roadmapsEntity();

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

					

		}

	?>
					