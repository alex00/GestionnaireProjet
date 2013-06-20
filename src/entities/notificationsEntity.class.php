
	<?php

				

		class notificationsEntity {
					
			private $notification_id;
			
			private $project_id;
			
			private $ticket_id;
			
			private $user_creator_id;
			
			private $announce_id;
			
			private $roadmap_id;
			
			private $type_id;
			


			/********************** GETTER ***********************/
			

			public function getNotification_id(){
				return $this->notification_id;
			}

			

			public function getProject_id(){
				return $this->project_id;
			}

			

			public function getTicket_id(){
				return $this->ticket_id;
			}

			

			public function getUser_creator_id(){
				return $this->user_creator_id;
			}

			

			public function getAnnounce_id(){
				return $this->announce_id;
			}

			

			public function getRoadmap_id(){
				return $this->roadmap_id;
			}

			

			public function getType_id(){
				return $this->type_id;
			}

			
			/********************** SETTER ***********************/

			public function setNotification_id($val){
				$this->notification_id =  $val;
			}

					

			public function setProject_id($val){
				$this->project_id =  $val;
			}

					

			public function setTicket_id($val){
				$this->ticket_id =  $val;
			}

					

			public function setUser_creator_id($val){
				$this->user_creator_id =  $val;
			}

					

			public function setAnnounce_id($val){
				$this->announce_id =  $val;
			}

					

			public function setRoadmap_id($val){
				$this->roadmap_id =  $val;
			}

					

			public function setType_id($val){
				$this->type_id =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->notification_id)){

					$sql = "DELETE FROM notifications WHERE notification_id = ".intval($this->notification_id).";";

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

				$sql = 'UPDATE `notifications` SET `notification_id` = "'.$this->notification_id.'", `project_id` = "'.$this->project_id.'", `ticket_id` = "'.$this->ticket_id.'", `user_creator_id` = "'.$this->user_creator_id.'", `announce_id` = "'.$this->announce_id.'", `roadmap_id` = "'.$this->roadmap_id.'", `type_id` = "'.$this->type_id.'" WHERE notification_id = '.intval($this->notification_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->notification_id)){
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

				$this->notification_id = '';

				$sql = 'INSERT INTO notifications (`notification_id`,`project_id`,`ticket_id`,`user_creator_id`,`announce_id`,`roadmap_id`,`type_id`) VALUES ("'.$this->notification_id.'","'.$this->project_id.'","'.$this->ticket_id.'","'.$this->user_creator_id.'","'.$this->announce_id.'","'.$this->roadmap_id.'","'.$this->type_id.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->notification_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM notifications';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new notificationsEntity();

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
					
					case $param == 'notification_id':
						$param = 'notification_id';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					case $param == 'user_creator_id':
						$param = 'user_creator_id';
						break;
						
					case $param == 'announce_id':
						$param = 'announce_id';
						break;
						
					case $param == 'roadmap_id':
						$param = 'roadmap_id';
						break;
						
					case $param == 'type_id':
						$param = 'type_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM notifications WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->notification_id = $result->notification_id;
					$this->project_id = $result->project_id;
					$this->ticket_id = $result->ticket_id;
					$this->user_creator_id = $result->user_creator_id;
					$this->announce_id = $result->announce_id;
					$this->roadmap_id = $result->roadmap_id;
					$this->type_id = $result->type_id;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM notifications WHERE notification_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->notification_id = $formatResult->notification_id;
					$this->project_id = $formatResult->project_id;
					$this->ticket_id = $formatResult->ticket_id;
					$this->user_creator_id = $formatResult->user_creator_id;
					$this->announce_id = $formatResult->announce_id;
					$this->roadmap_id = $formatResult->roadmap_id;
					$this->type_id = $formatResult->type_id;
				
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
					
					case $param == 'notification_id':
						$param = 'notification_id';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					case $param == 'user_creator_id':
						$param = 'user_creator_id';
						break;
						
					case $param == 'announce_id':
						$param = 'announce_id';
						break;
						
					case $param == 'roadmap_id':
						$param = 'roadmap_id';
						break;
						
					case $param == 'type_id':
						$param = 'type_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM notifications WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new notificationsEntity();

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
					