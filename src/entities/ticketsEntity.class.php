<?php
		use Components\SQLEntities\TzSQL;
		use Components\DebugTools\DebugTool;

		class ticketsEntity {
					
			private $ticket_id;
			
			private $ticket_name;
			
			private $ticket_code;
			
			private $ticket_date_create;
			
			private $ticket_date_update;
			
			private $ticket_deadline;
			
			private $ticket_estimate_time;
			
			private $ticket_spend_time;
			
			private $ticket_progress;
			
			private $ticket_description;
			
			private $project_id;
			
			private $priority_id;
			
			private $statut_id;
			
			private $tracker_id;
			
			private $roadmap_id;
			
			private $creator_id;
			
            private $relations = array('trackers'=>array('tracker_id'=>'tracker_id'),'projects'=>array('project_id'=>'project_id'),'status'=>array('statut_id'=>'status_id'),'priorities'=>array('priority_id'=>'priority_id'),);
        
            private $trackers;
            
            private $projects;
            
            private $status;
            
            private $priorities;
            



			/********************** GETTER ***********************/
			

			public function getTicket_id(){
				return $this->ticket_id;
			}

			

			public function getTicket_name(){
				return $this->ticket_name;
			}

			

			public function getTicket_code(){
				return $this->ticket_code;
			}

			

			public function getTicket_date_create(){
				return $this->ticket_date_create;
			}

			

			public function getTicket_date_update(){
				return $this->ticket_date_update;
			}

			

			public function getTicket_deadline(){
				return $this->ticket_deadline;
			}

			

			public function getTicket_estimate_time(){
				return $this->ticket_estimate_time;
			}

			

			public function getTicket_spend_time(){
				return $this->ticket_spend_time;
			}

			

			public function getTicket_progress(){
				return $this->ticket_progress;
			}

			

			public function getTicket_description(){
				return $this->ticket_description;
			}

			

			public function getProject_id(){
				return $this->project_id;
			}

			

			public function getPriority_id(){
				return $this->priority_id;
			}

			

			public function getStatut_id(){
				return $this->statut_id;
			}

			

			public function getTracker_id(){
				return $this->tracker_id;
			}

			

			public function getRoadmap_id(){
				return $this->roadmap_id;
			}

			

			public function getCreator_id(){
				return $this->creator_id;
			}

			
			/********************** SETTER ***********************/

			public function setTicket_id($val){
				$this->ticket_id =  $val;
			}

					

			public function setTicket_name($val){
				$this->ticket_name =  $val;
			}

					

			public function setTicket_code($val){
				$this->ticket_code =  $val;
			}

					

			public function setTicket_date_create($val){
				$this->ticket_date_create =  $val;
			}

					

			public function setTicket_date_update($val){
				$this->ticket_date_update =  $val;
			}

					

			public function setTicket_deadline($val){
				$this->ticket_deadline =  $val;
			}

					

			public function setTicket_estimate_time($val){
				$this->ticket_estimate_time =  $val;
			}

					

			public function setTicket_spend_time($val){
				$this->ticket_spend_time =  $val;
			}

					

			public function setTicket_progress($val){
				$this->ticket_progress =  $val;
			}

					

			public function setTicket_description($val){
				$this->ticket_description =  $val;
			}

					

			public function setProject_id($val){
				$this->project_id =  $val;
			}

					

			public function setPriority_id($val){
				$this->priority_id =  $val;
			}

					

			public function setStatut_id($val){
				$this->statut_id =  $val;
			}

					

			public function setTracker_id($val){
				$this->tracker_id =  $val;
			}

					

			public function setRoadmap_id($val){
				$this->roadmap_id =  $val;
			}

					

			public function setCreator_id($val){
				$this->creator_id =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->ticket_id)){

					$sql = "DELETE FROM tickets WHERE ticket_id = ".intval($this->ticket_id).";";

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

				$sql = 'UPDATE `tickets` SET `ticket_id` = "'.$this->ticket_id.'", `ticket_name` = "'.$this->ticket_name.'", `ticket_code` = "'.$this->ticket_code.'", `ticket_date_create` = "'.$this->ticket_date_create.'", `ticket_date_update` = "'.$this->ticket_date_update.'", `ticket_deadline` = "'.$this->ticket_deadline.'", `ticket_estimate_time` = "'.$this->ticket_estimate_time.'", `ticket_spend_time` = "'.$this->ticket_spend_time.'", `ticket_progress` = "'.$this->ticket_progress.'", `ticket_description` = "'.$this->ticket_description.'", `project_id` = "'.$this->project_id.'", `priority_id` = "'.$this->priority_id.'", `statut_id` = "'.$this->statut_id.'", `tracker_id` = "'.$this->tracker_id.'", `roadmap_id` = "'.$this->roadmap_id.'", `creator_id` = "'.$this->creator_id.'" WHERE ticket_id = '.intval($this->ticket_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->ticket_id)){
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

				$this->ticket_id = '';

				$sql = 'INSERT INTO tickets (`ticket_id`,`ticket_name`,`ticket_code`,`ticket_date_create`,`ticket_date_update`,`ticket_deadline`,`ticket_estimate_time`,`ticket_spend_time`,`ticket_progress`,`ticket_description`,`project_id`,`priority_id`,`statut_id`,`tracker_id`,`roadmap_id`,`creator_id`) VALUES ("'.$this->ticket_id.'","'.$this->ticket_name.'","'.$this->ticket_code.'","'.$this->ticket_date_create.'","'.$this->ticket_date_update.'","'.$this->ticket_deadline.'","'.$this->ticket_estimate_time.'","'.$this->ticket_spend_time.'","'.$this->ticket_progress.'","'.$this->ticket_description.'","'.$this->project_id.'","'.$this->priority_id.'","'.$this->statut_id.'","'.$this->tracker_id.'","'.$this->roadmap_id.'","'.$this->creator_id.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->ticket_id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll($recursif = 'yes'){

				$sql = 'SELECT * FROM tickets';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new ticketsEntity();

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
					
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					case $param == 'ticket_name':
						$param = 'ticket_name';
						break;
						
					case $param == 'ticket_code':
						$param = 'ticket_code';
						break;
						
					case $param == 'ticket_date_create':
						$param = 'ticket_date_create';
						break;
						
					case $param == 'ticket_date_update':
						$param = 'ticket_date_update';
						break;
						
					case $param == 'ticket_deadline':
						$param = 'ticket_deadline';
						break;
						
					case $param == 'ticket_estimate_time':
						$param = 'ticket_estimate_time';
						break;
						
					case $param == 'ticket_spend_time':
						$param = 'ticket_spend_time';
						break;
						
					case $param == 'ticket_progress':
						$param = 'ticket_progress';
						break;
						
					case $param == 'ticket_description':
						$param = 'ticket_description';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'priority_id':
						$param = 'priority_id';
						break;
						
					case $param == 'statut_id':
						$param = 'statut_id';
						break;
						
					case $param == 'tracker_id':
						$param = 'tracker_id';
						break;
						
					case $param == 'roadmap_id':
						$param = 'roadmap_id';
						break;
						
					case $param == 'creator_id':
						$param = 'creator_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM tickets WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->ticket_id = $result->ticket_id;
					$this->ticket_name = $result->ticket_name;
					$this->ticket_code = $result->ticket_code;
					$this->ticket_date_create = $result->ticket_date_create;
					$this->ticket_date_update = $result->ticket_date_update;
					$this->ticket_deadline = $result->ticket_deadline;
					$this->ticket_estimate_time = $result->ticket_estimate_time;
					$this->ticket_spend_time = $result->ticket_spend_time;
					$this->ticket_progress = $result->ticket_progress;
					$this->ticket_description = $result->ticket_description;
					$this->project_id = $result->project_id;
					
                    $entityProject_id = tzSQL::getEntity('projects');
                    $contentProject_id =  $entityProject_id->findManyBy('project_id',$result->project_id, 'no');
                    $this->projects = $contentProject_id;
                $this->priority_id = $result->priority_id;
					
                    $entityPriority_id = tzSQL::getEntity('priorities');
                    $contentPriority_id =  $entityPriority_id->findManyBy('priority_id',$result->priority_id, 'no');
                    $this->priorities = $contentPriority_id;
                $this->statut_id = $result->statut_id;
					
                    $entityStatut_id = tzSQL::getEntity('status');
                    $contentStatut_id =  $entityStatut_id->findManyBy('status_id',$result->statut_id, 'no');
                    $this->status = $contentStatut_id;
                $this->tracker_id = $result->tracker_id;
					
                    $entityTracker_id = tzSQL::getEntity('trackers');
                    $contentTracker_id =  $entityTracker_id->findManyBy('tracker_id',$result->tracker_id, 'no');
                    $this->trackers = $contentTracker_id;
                $this->roadmap_id = $result->roadmap_id;
					$this->creator_id = $result->creator_id;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM tickets WHERE ticket_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->ticket_id = $formatResult->ticket_id;
					$this->ticket_name = $formatResult->ticket_name;
					$this->ticket_code = $formatResult->ticket_code;
					$this->ticket_date_create = $formatResult->ticket_date_create;
					$this->ticket_date_update = $formatResult->ticket_date_update;
					$this->ticket_deadline = $formatResult->ticket_deadline;
					$this->ticket_estimate_time = $formatResult->ticket_estimate_time;
					$this->ticket_spend_time = $formatResult->ticket_spend_time;
					$this->ticket_progress = $formatResult->ticket_progress;
					$this->ticket_description = $formatResult->ticket_description;
					$this->project_id = $formatResult->project_id;
				
                    $entityProject_id = tzSQL::getEntity('projects');
                    $contentProject_id =  $entityProject_id->findManyBy('project_id',$formatResult->project_id, 'no');
                    $this->projects = $contentProject_id;
                	$this->priority_id = $formatResult->priority_id;
				
                    $entityPriority_id = tzSQL::getEntity('priorities');
                    $contentPriority_id =  $entityPriority_id->findManyBy('priority_id',$formatResult->priority_id, 'no');
                    $this->priorities = $contentPriority_id;
                	$this->statut_id = $formatResult->statut_id;
				
                    $entityStatut_id = tzSQL::getEntity('status');
                    $contentStatut_id =  $entityStatut_id->findManyBy('status_id',$formatResult->statut_id, 'no');
                    $this->status = $contentStatut_id;
                	$this->tracker_id = $formatResult->tracker_id;
				
                    $entityTracker_id = tzSQL::getEntity('trackers');
                    $contentTracker_id =  $entityTracker_id->findManyBy('tracker_id',$formatResult->tracker_id, 'no');
                    $this->trackers = $contentTracker_id;
                	$this->roadmap_id = $formatResult->roadmap_id;
					$this->creator_id = $formatResult->creator_id;
				
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
					
					case $param == 'ticket_id':
						$param = 'ticket_id';
						break;
						
					case $param == 'ticket_name':
						$param = 'ticket_name';
						break;
						
					case $param == 'ticket_code':
						$param = 'ticket_code';
						break;
						
					case $param == 'ticket_date_create':
						$param = 'ticket_date_create';
						break;
						
					case $param == 'ticket_date_update':
						$param = 'ticket_date_update';
						break;
						
					case $param == 'ticket_deadline':
						$param = 'ticket_deadline';
						break;
						
					case $param == 'ticket_estimate_time':
						$param = 'ticket_estimate_time';
						break;
						
					case $param == 'ticket_spend_time':
						$param = 'ticket_spend_time';
						break;
						
					case $param == 'ticket_progress':
						$param = 'ticket_progress';
						break;
						
					case $param == 'ticket_description':
						$param = 'ticket_description';
						break;
						
					case $param == 'project_id':
						$param = 'project_id';
						break;
						
					case $param == 'priority_id':
						$param = 'priority_id';
						break;
						
					case $param == 'statut_id':
						$param = 'statut_id';
						break;
						
					case $param == 'tracker_id':
						$param = 'tracker_id';
						break;
						
					case $param == 'roadmap_id':
						$param = 'roadmap_id';
						break;
						
					case $param == 'creator_id':
						$param = 'creator_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM tickets WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new ticketsEntity();

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


            public function countTicketsTotal($project_id){
                $sql = 'SELECT COUNT(*) AS nb_total FROM `tickets` WHERE `project_id` = '.$project_id;

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $tickets = $result->fetch(PDO::FETCH_OBJ);

                return $tickets->nb_total;
            }

            public function countAssignedTickets($project_id){
                $sql = 'SELECT COUNT(*) AS nb_assigned FROM `tickets` WHERE `project_id` = '.$project_id.' AND statut_id = 1';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $tickets = $result->fetch(PDO::FETCH_OBJ);

                return $tickets->nb_assigned;
            }

            public function countInprogressTickets($project_id){
                $sql = 'SELECT COUNT(*) AS nb_inprogress FROM `tickets` WHERE `project_id` = '.$project_id.' AND statut_id = 2';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $tickets = $result->fetch(PDO::FETCH_OBJ);

                return $tickets->nb_inprogress;
            }

            public function countResolvedTickets($project_id){
                $sql = 'SELECT COUNT(*) AS nb_resolved FROM `tickets` WHERE `project_id` = '.$project_id.' AND statut_id = 3';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $tickets = $result->fetch(PDO::FETCH_OBJ);

                return $tickets->nb_resolved;
            }

            public function countClosedTickets($project_id){
                $sql = 'SELECT COUNT(*) AS nb_closed FROM `tickets` WHERE `project_id` = '.$project_id.' AND statut_id = 4';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $tickets = $result->fetch(PDO::FETCH_OBJ);

                return $tickets->nb_closed;
            }

            public function countCanceledTickets($project_id){
                $sql = 'SELECT COUNT(*) AS nb_canceled FROM `tickets` WHERE `project_id` = '.$project_id.' AND statut_id = 5';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $tickets = $result->fetch(PDO::FETCH_OBJ);

                return $tickets->nb_canceled;
            }

            public function countEvolutionTickets($project_id){
                $sql = 'SELECT COUNT(*) AS nb_evolution FROM `tickets` WHERE `project_id` = '.$project_id.' AND tracker_id = 1';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $tickets = $result->fetch(PDO::FETCH_OBJ);

                return $tickets->nb_evolution;
            }

            public function countBugTickets($project_id){
                $sql = 'SELECT COUNT(*) AS nb_evolution FROM `tickets` WHERE `project_id` = '.$project_id.' AND tracker_id = 2';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $tickets = $result->fetch(PDO::FETCH_OBJ);

                return $tickets->nb_evolution;
            }

            public function countSupportTickets($project_id){
                $sql = 'SELECT COUNT(*) AS nb_evolution FROM `tickets` WHERE `project_id` = '.$project_id.' AND tracker_id = 3';

                $result = TzSQL::getPDO()->prepare($sql);
                $result->execute();
                $tickets = $result->fetch(PDO::FETCH_OBJ);

                return $tickets->nb_evolution;
            }

            public function myTickets($user_id, $project_id){
                $sql = 'SELECT *
                        FROM `users_receive_tickets`
                        LEFT JOIN `tickets` ON `users_receive_tickets`.`ticket_id` = `tickets`.`ticket_id`
                        WHERE `users_receive_tickets`.`user_id` = '.$user_id. ' AND `tickets`.`project_id` = '.$project_id.'
                        ORDER BY `tickets`.`ticket_date_create` ASC';

                $pdo = TzSQL::getPDO();

                foreach  ($pdo->query($sql) as $row) {
                    $myTickets[] = $row;

                }

                if (!isset($myTickets))
                    return false;

                return $myTickets;

            }


            public function allTickets($project_id){
                $sql = 'SELECT *
                        FROM `tickets`
                        LEFT JOIN `users_receive_tickets` ON `tickets`.`ticket_id` = `users_receive_tickets`.`ticket_id`
                        LEFT JOIN `users` ON `users`.`id` = `users_receive_tickets`.`user_id`
                        WHERE `tickets`.`project_id` = '.$project_id.'
                        ORDER BY `tickets`.`ticket_date_create` ASC';

                $pdo = TzSQL::getPDO();

                foreach  ($pdo->query($sql) as $row) {
                    $allTickets[] = $row;

                }

                if (!isset($allTickets))
                    return false;


                return $allTickets;

            }


            public function getDetailTicket($project_id, $ticket_id){
                $sql = 'SELECT *
                        FROM `tickets`
                        LEFT JOIN `users_receive_tickets` ON `tickets`.`ticket_id` = `users_receive_tickets`.`ticket_id`
                        LEFT JOIN `users` ON `users`.`id` = `users_receive_tickets`.`user_id`
                        LEFT JOIN `status` ON `status`.`status_id` = `tickets`.`statut_id`
                        LEFT JOIN `trackers` ON `trackers`.`tracker_id` = `tickets`.`tracker_id`
                        LEFT JOIN `priorities` ON `priorities`.`priority_id` = `tickets`.`priority_id`
                        WHERE `tickets`.`project_id` = '.$project_id.'
                        AND `users_receive_tickets`.`ticket_id` = '.$ticket_id.'
                        ORDER BY `tickets`.`ticket_date_create` ASC';

                $pdo = TzSQL::getPDO();

                foreach  ($pdo->query($sql) as $row) {
                    $detailTicket[] = $row;

                }

                if (!isset($detailTicket))
                    return false;


                return $detailTicket[0];

            }

            public function getTicketsByUser ($project_id, $user_id){
                $sql = 'SELECT *
                        FROM `tickets`
                        LEFT JOIN `users_receive_tickets` ON `tickets`.`ticket_id` = `users_receive_tickets`.`ticket_id`
                        LEFT JOIN `users` ON `users`.`id` = `users_receive_tickets`.`user_id`
                        LEFT JOIN `status` ON `status`.`status_id` = `tickets`.`statut_id`
                        LEFT JOIN `trackers` ON `trackers`.`tracker_id` = `tickets`.`tracker_id`
                        LEFT JOIN `roadmaps` ON `roadmaps`.`roadmap_id` = `tickets`.`roadmap_id`
                        LEFT JOIN `priorities` ON `priorities`.`priority_id` = `tickets`.`priority_id`
                        WHERE `tickets`.`project_id` = '.$project_id.'
                        AND `users_receive_tickets`.`user_id` = '.$user_id.'
                        ORDER BY `tickets`.`ticket_date_create` ASC';

                $pdo = TzSQL::getPDO();
                $count = 0;
                $cat['1'] = 0;
                $cat['2'] = 0;
                $cat['3'] = 0;
                $road = array();
                $status['complete'] = 0;
                $status['1'] = 0;
                $status['2'] = 0;
                $status['3'] = 0;
                $status['4'] = 0;
                $status['5'] = 0;
                foreach  ($pdo->query($sql) as $row) {

                    if (!isset($road[$row['roadmap_id']]['count']))
                        $road[$row['roadmap_id']]['count'] = 0;

                    if ($row['status_id'] == 4 || $row['status_id'] == 5)
                        $status['complete'] = $status['complete'] + 1;

                    $cat[$row['tracker_id']]++;
                    $status[$row['status_id']]++;
                    $road[$row['roadmap_id']]['count'] = $road[$row['roadmap_id']]['count'] + 1;


                    $count++;
                }

                foreach ($road as $key=>$r){
                    $roadmap = tzSQL::getEntity('roadmaps');

                    if ($res = $roadmap->findOneBy('roadmap_id',$key))
                        $road[$key]['name'] = $roadmap->getRoadmap_title();
                    else
                        $road[$key]['name'] = 'No Affiliated';
                }


                $res['cat'] = $cat;
                $res['status'] = $status;
                $res['roadmap'] = $road;
                $res['count'] = $count;
                $res['countRoad'] = count($res['roadmap']);
                $res['progress'] = round($res['status']['complete'] * 100 / $count);

                return $res;

            }

					

		}

	?>
					