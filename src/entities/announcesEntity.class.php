<?php
		use Components\SQLEntities\TzSQL;
		use Components\DebugTools\DebugTool;

		class announcesEntity {

			private $announce_id;

			private $announce_title;

			private $announce_code;

			private $announce_date_create;

			private $announce_date_update;

			private $announce_description;

			private $creator_id;

			private $project_id;

            private $relations = array();




			/********************** GETTER ***********************/


			public function getAnnounce_id(){
				return $this->announce_id;
			}



			public function getAnnounce_title(){
				return $this->announce_title;
			}



			public function getAnnounce_code(){
				return $this->announce_code;
			}



			public function getAnnounce_date_create(){
				return $this->announce_date_create;
			}



			public function getAnnounce_date_update(){
				return $this->announce_date_update;
			}



			public function getAnnounce_description(){
				return $this->announce_description;
			}



			public function getCreator_id(){
				return $this->creator_id;
			}



			public function getProject_id(){
				return $this->project_id;
			}


			/********************** SETTER ***********************/

			public function setAnnounce_id($val){
				$this->announce_id =  $val;
			}



			public function setAnnounce_title($val){
				$this->announce_title =  $val;
			}



			public function setAnnounce_code($val){
				$this->announce_code =  $val;
			}



			public function setAnnounce_date_create($val){
				$this->announce_date_create =  $val;
			}



			public function setAnnounce_date_update($val){
				$this->announce_date_update =  $val;
			}



			public function setAnnounce_description($val){
				$this->announce_description =  $val;
			}



			public function setCreator_id($val){
				$this->creator_id =  $val;
			}



			public function setProject_id($val){
				$this->project_id =  $val;
			}



			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->announce_id)){

					$sql = "DELETE FROM announces WHERE announce_id = ".intval($this->announce_id).";";

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

				$sql = 'UPDATE `announces` SET `announce_id` = "'.$this->announce_id.'", `announce_title` = "'.$this->announce_title.'", `announce_code` = "'.$this->announce_code.'", `announce_date_create` = "'.$this->announce_date_create.'", `announce_date_update` = "'.$this->announce_date_update.'", `announce_description` = "'.$this->announce_description.'", `creator_id` = "'.$this->creator_id.'", `project_id` = "'.$this->project_id.'" WHERE announce_id = '.intval($this->announce_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->announce_id)){
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

				$this->announce_id = '';

				$sql = 'INSERT INTO announces (`announce_id`,`announce_title`,`announce_code`,`announce_date_create`,`announce_date_update`,`announce_description`,`creator_id`,`project_id`) VALUES ("'.$this->announce_id.'","'.$this->announce_title.'","'.$this->announce_code.'","'.$this->announce_date_create.'","'.$this->announce_date_update.'","'.$this->announce_description.'","'.$this->creator_id.'","'.$this->project_id.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->announce_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}


			/********************** FindAll ***********************/
			public function findAll($recursif = 'yes'){

				$sql = 'SELECT * FROM announces';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new announcesEntity();

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

					case $param == 'announce_id':
						$param = 'announce_id';
						break;

					case $param == 'announce_title':
						$param = 'announce_title';
						break;

					case $param == 'announce_code':
						$param = 'announce_code';
						break;

					case $param == 'announce_date_create':
						$param = 'announce_date_create';
						break;

					case $param == 'announce_date_update':
						$param = 'announce_date_update';
						break;

					case $param == 'announce_description':
						$param = 'announce_description';
						break;

					case $param == 'creator_id':
						$param = 'creator_id';
						break;

					case $param == 'project_id':
						$param = 'project_id';
						break;

					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM announces WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->announce_id = $result->announce_id;
					$this->announce_title = $result->announce_title;
					$this->announce_code = $result->announce_code;
					$this->announce_date_create = $result->announce_date_create;
					$this->announce_date_update = $result->announce_date_update;
					$this->announce_description = $result->announce_description;
					$this->creator_id = $result->creator_id;
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

				$sql = 'SELECT * FROM announces WHERE announce_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->announce_id = $formatResult->announce_id;
					$this->announce_title = $formatResult->announce_title;
					$this->announce_code = $formatResult->announce_code;
					$this->announce_date_create = $formatResult->announce_date_create;
					$this->announce_date_update = $formatResult->announce_date_update;
					$this->announce_description = $formatResult->announce_description;
					$this->creator_id = $formatResult->creator_id;
					$this->project_id = $formatResult->project_id;

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

					case $param == 'announce_id':
						$param = 'announce_id';
						break;

					case $param == 'announce_title':
						$param = 'announce_title';
						break;

					case $param == 'announce_code':
						$param = 'announce_code';
						break;

					case $param == 'announce_date_create':
						$param = 'announce_date_create';
						break;

					case $param == 'announce_date_update':
						$param = 'announce_date_update';
						break;

					case $param == 'announce_description':
						$param = 'announce_description';
						break;

					case $param == 'creator_id':
						$param = 'creator_id';
						break;

					case $param == 'project_id':
						$param = 'project_id';
						break;

					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM announces WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new announcesEntity();

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





            public function allAnnounces($project_id){
                $sql = 'SELECT *
                        FROM `announces`
                        LEFT JOIN `users` ON `users`.`id` = `announces`.`creator_id`
                        WHERE `announces`.`project_id` = '.$project_id.'
                        ORDER BY `announces`.`announce_date_create` ASC';

                $pdo = TzSQL::getPDO();

                foreach  ($pdo->query($sql) as $row) {
                    $allAnnounces[] = $row;

                }

                if (!isset($allAnnounces))
                    return false;

                return $allAnnounces;

            }


            public function countAnnounce($project_id){
                $sql = 'SELECT COUNT(`announce_id`) as nb_total
                        FROM `announces`
                        WHERE `announces`.`project_id` = '.$project_id;

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $tickets = $result->fetch(PDO::FETCH_OBJ);

                return $tickets->nb_total;

            }
            public function countAnnouncesProject($project_id){
                $sql = 'SELECT COUNT(*) as nb_announces
                        FROM `announces`
                        WHERE `project_id` = '.$project_id.'
                        ORDER BY `announces`.`announce_date_create` ASC';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $nb = $result->fetch(PDO::FETCH_OBJ);

                return $nb->nb_announces;

            }

            public function getLastAnnounce($project_id){
                $sql = 'SELECT announce_title as last_announce
                        FROM `announces`
                        WHERE `project_id` = '.$project_id.'
                        ORDER BY announce_date_create DESC
                        LIMIT 0,1';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $nb = $result->fetch(PDO::FETCH_OBJ);
                if(!$nb)
                    return false;
                return $nb->last_announce;

            }

		}

	?>
					