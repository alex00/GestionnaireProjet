
	<?php

				

		class notificationsEntity {
					
			private $notification_id;
			
			private $project_id;
			
			private $ticket_id;
			
			private $user_creator_id;
			
			private $announcement_id;
			
			private $notification_date_create;
			
			private $notification_view;
			
			private $type_id;
			
			private $user_receive_id;
			


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

			

			public function getAnnouncement_id(){
				return $this->announcement_id;
			}

			

			public function getNotification_date_create(){
				return $this->notification_date_create;
			}

			

			public function getNotification_view(){
				return $this->notification_view;
			}

			

			public function getType_id(){
				return $this->type_id;
			}

			

			public function getUser_receive_id(){
				return $this->user_receive_id;
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

					

			public function setAnnouncement_id($val){
				$this->announcement_id =  $val;
			}

					

			public function setNotification_date_create($val){
				$this->notification_date_create =  $val;
			}

					

			public function setNotification_view($val){
				$this->notification_view =  $val;
			}

					

			public function setType_id($val){
				$this->type_id =  $val;
			}

					

			public function setUser_receive_id($val){
				$this->user_receive_id =  $val;
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

				$sql = 'UPDATE `notifications` SET `notification_id` = "'.$this->notification_id.'", `project_id` = "'.$this->project_id.'", `ticket_id` = "'.$this->ticket_id.'", `user_creator_id` = "'.$this->user_creator_id.'", `announcement_id` = "'.$this->announcement_id.'", `notification_date_create` = "'.$this->notification_date_create.'", `notification_view` = "'.$this->notification_view.'", `type_id` = "'.$this->type_id.'", `user_receive_id` = "'.$this->user_receive_id.'" WHERE notification_id = '.intval($this->notification_id);

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

				$sql = 'INSERT INTO notifications (`notification_id`,`project_id`,`ticket_id`,`user_creator_id`,`announcement_id`,`notification_date_create`,`notification_view`,`type_id`,`user_receive_id`) VALUES ("'.$this->notification_id.'","'.$this->project_id.'","'.$this->ticket_id.'","'.$this->user_creator_id.'","'.$this->announcement_id.'","'.$this->notification_date_create.'","'.$this->notification_view.'","'.$this->type_id.'","'.$this->user_receive_id.'")';

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
						
					case $param == 'announcement_id':
						$param = 'announcement_id';
						break;
						
					case $param == 'notification_date_create':
						$param = 'notification_date_create';
						break;
						
					case $param == 'notification_view':
						$param = 'notification_view';
						break;
						
					case $param == 'type_id':
						$param = 'type_id';
						break;
						
					case $param == 'user_receive_id':
						$param = 'user_receive_id';
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
					$this->announcement_id = $result->announcement_id;
					$this->notification_date_create = $result->notification_date_create;
					$this->notification_view = $result->notification_view;
					$this->type_id = $result->type_id;
					$this->user_receive_id = $result->user_receive_id;
					
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
					$this->announcement_id = $formatResult->announcement_id;
					$this->notification_date_create = $formatResult->notification_date_create;
					$this->notification_view = $formatResult->notification_view;
					$this->type_id = $formatResult->type_id;
					$this->user_receive_id = $formatResult->user_receive_id;
				
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
						
					case $param == 'announcement_id':
						$param = 'announcement_id';
						break;
						
					case $param == 'notification_date_create':
						$param = 'notification_date_create';
						break;
						
					case $param == 'notification_view':
						$param = 'notification_view';
						break;
						
					case $param == 'type_id':
						$param = 'type_id';
						break;
						
					case $param == 'user_receive_id':
						$param = 'user_receive_id';
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
					