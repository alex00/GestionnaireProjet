<?php
		use Components\SQLEntities\TzSQL;
		use Components\DebugTools\DebugTool;

		class users_receive_ticketsEntity {
					
			private $id;
			
			private $user_id;
			
			private $ticket_id;
			
            private $relations = array('users'=>array('user_id'=>'id'),'tickets'=>array('ticket_id'=>'ticket_id'),);
        
            private $users;
            
            private $tickets;
            



			/********************** GETTER ***********************/
			

			public function getId(){
				return $this->id;
			}

			

			public function getUser_id(){
				return $this->user_id;
			}

			

			public function getTicket_id(){
				return $this->ticket_id;
			}

			
			/********************** SETTER ***********************/

			public function setId($val){
				$this->id =  $val;
			}

					

			public function setUser_id($val){
				$this->user_id =  $val;
			}

					

			public function setTicket_id($val){
				$this->ticket_id =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->id)){

					$sql = "DELETE FROM users_receive_tickets WHERE id = ".intval($this->id).";";

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

				$sql = 'UPDATE `users_receive_tickets` SET `id` = "'.$this->id.'", `user_id` = "'.$this->user_id.'", `ticket_id` = "'.$this->ticket_id.'" WHERE id = '.intval($this->id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->id)){
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

				$this->id = '';

				$sql = 'INSERT INTO users_receive_tickets (`id`,`user_id`,`ticket_id`) VALUES ("'.$this->id.'","'.$this->user_id.'","'.$this->ticket_id.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll($recursif = 'yes'){

				$sql = 'SELECT * FROM users_receive_tickets';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new users_receive_ticketsEntity();

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
					
					case $param == 'id':
						$param = 'id';
						break;
						
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM users_receive_tickets WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->id = $result->id;
					$this->user_id = $result->user_id;
					
                    $entityUser_id = tzSQL::getEntity('users');
                    $contentUser_id =  $entityUser_id->findManyBy('id',$result->user_id, 'no');
                    $this->users = $contentUser_id;
                $this->ticket_id = $result->ticket_id;
					
                    $entityTicket_id = tzSQL::getEntity('tickets');
                    $contentTicket_id =  $entityTicket_id->findManyBy('ticket_id',$result->ticket_id, 'no');
                    $this->tickets = $contentTicket_id;
                
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM users_receive_tickets WHERE id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->id = $formatResult->id;
					$this->user_id = $formatResult->user_id;
				
                    $entityUser_id = tzSQL::getEntity('users');
                    $contentUser_id =  $entityUser_id->findManyBy('id',$formatResult->user_id, 'no');
                    $this->users = $contentUser_id;
                	$this->ticket_id = $formatResult->ticket_id;
				
                    $entityTicket_id = tzSQL::getEntity('tickets');
                    $contentTicket_id =  $entityTicket_id->findManyBy('ticket_id',$formatResult->ticket_id, 'no');
                    $this->tickets = $contentTicket_id;
                
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
					
					case $param == 'id':
						$param = 'id';
						break;
						
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM users_receive_tickets WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new users_receive_ticketsEntity();

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

            public function countAssignedTickets($user_id){

                $sql = 'SELECT COUNT( users_receive_tickets.ticket_id) as nb_assigned FROM  `users_receive_tickets` LEFT JOIN tickets ON users_receive_tickets.ticket_id = tickets.ticket_id WHERE users_receive_tickets.user_id ='.$user_id.' AND tickets.statut_id =1';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $nb = $result->fetch(PDO::FETCH_OBJ);

                return $nb->nb_assigned;
            }
            public function countInProgressTickets($user_id){
                $sql = 'SELECT COUNT( users_receive_tickets.ticket_id) as nb_inprogress FROM  `users_receive_tickets` LEFT JOIN tickets ON users_receive_tickets.ticket_id = tickets.ticket_id WHERE users_receive_tickets.user_id ='.$user_id.' AND tickets.statut_id =2';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $nb = $result->fetch(PDO::FETCH_OBJ);

                return $nb->nb_inprogress;
            }

            public function countResolvedTickets($user_id){
                $sql = 'SELECT COUNT( users_receive_tickets.ticket_id) as nb_resolved FROM  `users_receive_tickets` LEFT JOIN tickets ON users_receive_tickets.ticket_id = tickets.ticket_id WHERE users_receive_tickets.user_id ='.$user_id.' AND tickets.statut_id =3';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $nb = $result->fetch(PDO::FETCH_OBJ);

                return $nb->nb_resolved;
            }

            public function countClosedTickets($user_id){
                $sql = 'SELECT COUNT( users_receive_tickets.ticket_id) as nb_closed FROM  `users_receive_tickets` LEFT JOIN tickets ON users_receive_tickets.ticket_id = tickets.ticket_id WHERE users_receive_tickets.user_id ='.$user_id.' AND tickets.statut_id =4';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $nb = $result->fetch(PDO::FETCH_OBJ);

                return $nb->nb_closed;
            }

            public function countCanceledTickets($user_id){
                $sql = 'SELECT COUNT( users_receive_tickets.ticket_id) as nb_canceled FROM  `users_receive_tickets` LEFT JOIN tickets ON users_receive_tickets.ticket_id = tickets.ticket_id WHERE users_receive_tickets.user_id ='.$user_id.' AND tickets.statut_id =5';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $nb = $result->fetch(PDO::FETCH_OBJ);

                return $nb->nb_canceled;
            }

		}

	?>
					