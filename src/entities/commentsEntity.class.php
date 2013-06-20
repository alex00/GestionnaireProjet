
	<?php

				

		class commentsEntity {
					
			private $comment_id;
			
			private $comment_description;
			
			private $comment_date_create;
			
			private $ticket_id;
			
			private $user_id;
			


			/********************** GETTER ***********************/
			

			public function getComment_id(){
				return $this->comment_id;
			}

			

			public function getComment_description(){
				return $this->comment_description;
			}

			

			public function getComment_date_create(){
				return $this->comment_date_create;
			}

			

			public function getTicket_id(){
				return $this->ticket_id;
			}

			

			public function getUser_id(){
				return $this->user_id;
			}

			
			/********************** SETTER ***********************/

			public function setComment_id($val){
				$this->comment_id =  $val;
			}

					

			public function setComment_description($val){
				$this->comment_description =  $val;
			}

					

			public function setComment_date_create($val){
				$this->comment_date_create =  $val;
			}

					

			public function setTicket_id($val){
				$this->ticket_id =  $val;
			}

					

			public function setUser_id($val){
				$this->user_id =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->comment_id)){

					$sql = "DELETE FROM comments WHERE comment_id = ".intval($this->comment_id).";";

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

				$sql = 'UPDATE `comments` SET `comment_id` = "'.$this->comment_id.'", `comment_description` = "'.$this->comment_description.'", `comment_date_create` = "'.$this->comment_date_create.'", `ticket_id` = "'.$this->ticket_id.'", `user_id` = "'.$this->user_id.'" WHERE comment_id = '.intval($this->comment_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->comment_id)){
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

				$this->comment_id = '';

				$sql = 'INSERT INTO comments (`comment_id`,`comment_description`,`comment_date_create`,`ticket_id`,`user_id`) VALUES ("'.$this->comment_id.'","'.$this->comment_description.'","'.$this->comment_date_create.'","'.$this->ticket_id.'","'.$this->user_id.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->comment_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM comments';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new commentsEntity();

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
					
					case $param == 'comment_id':
						$param = 'comment_id';
						break;
						
					case $param == 'comment_description':
						$param = 'comment_description';
						break;
						
					case $param == 'comment_date_create':
						$param = 'comment_date_create';
						break;
						
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM comments WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->comment_id = $result->comment_id;
					$this->comment_description = $result->comment_description;
					$this->comment_date_create = $result->comment_date_create;
					$this->ticket_id = $result->ticket_id;
					$this->user_id = $result->user_id;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM comments WHERE comment_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->comment_id = $formatResult->comment_id;
					$this->comment_description = $formatResult->comment_description;
					$this->comment_date_create = $formatResult->comment_date_create;
					$this->ticket_id = $formatResult->ticket_id;
					$this->user_id = $formatResult->user_id;
				
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
					
					case $param == 'comment_id':
						$param = 'comment_id';
						break;
						
					case $param == 'comment_description':
						$param = 'comment_description';
						break;
						
					case $param == 'comment_date_create':
						$param = 'comment_date_create';
						break;
						
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM comments WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new commentsEntity();

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
					