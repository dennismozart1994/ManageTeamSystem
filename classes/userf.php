<?php
	require_once('connection.php');
	class user
	{
		// ---------------- ACCESSIBILITY FUNCTIONS ------------------------- //
		// SIG IN
		public function login($user, $pass)
		{
			$connect = new connection;
			if($connect->tryconnect())
			{
				$connector = $connect->getConnector();
				$sql = "SELECT * FROM tab_user WHERE email_in_user=:u AND senha_user=:p";
				$query = $connector->prepare($sql);
				$query->bindParam(':u', $user, PDO::PARAM_STR);
				$query->bindParam(':p', $pass, PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				while($result=$query->FETCH(PDO::FETCH_OBJ))
				{
					$_SESSION['id'] = $result->id_user;
					$_SESSION['cc'] = $result->id_cc;
					$_SESSION['nome'] = $result->nome_user;
					$_SESSION['funcao'] = $result->funcao_user;
				}
				return $rowC;
			}
		}
		
		// LOGOUT
		public function logout()
		{
			unset($_SESSION['login']);
			unset($_SESSION['password']);
			unset($_SESSION['id']);
			unset($_SESSION['cc']);
			unset($_SESSION['nome']);
			unset($_SESSION['funcao']);
			session_destroy();
			header('Location: index.php');
		}
		
		// ---------------- PROJECT FUNCTIONS RELATED WITH THE USER ------------------------- //
		// USER RESPONSIBILITIES
		public function getProjects($type)
		{
			switch($type)
			{
				case "phase": self::byphase();
				break;
				case "finish": self::ended();
				break;
				case "status": self::bystatus();
				break;
				case "projectxanalyst": self::usersprojects();
				break;
			}
		}
		
		// GET AMOUNT OF PROJECTS BY PHASE
		public function byphase()
		{
			$connect = new connection;
			if($connect->tryconnect())
			{
				$connector = $connect->getConnector();
				$queryphases = "SELECT * from TAB_fases AS fases";
				$queryphases = $connector->prepare($queryphases);
				$queryphases->execute();
				$rowC = $queryphases->rowCount();
				if($rowC>0)
				{
					while($result=$queryphases->FETCH(PDO::FETCH_OBJ))
					{
						$fase = $result->id_f;
						$nome = $result->nome_f;
						$sqlproject = "SELECT COUNT(*) FROM TAB_projeto AS projeto INNER JOIN TAB_cc AS cliente ON projeto.id_cc = cliente.id_cc 
						WHERE projeto.id_f != 5 AND projeto.id_f != 8 AND projeto.id_f=:f AND projeto.id_cc=:cc";
						$queryproject = $connector->prepare($sqlproject);
						$queryproject->bindParam(':f', $fase, PDO::PARAM_STR);
						$queryproject->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
						$queryproject->execute();
						$count = $queryproject->FETCH(PDO::FETCH_NUM);
						if(reset($count)>0)
						{
							echo '<tr align="left">';
							echo '<td>'.utf8_encode($nome).'</td>';
							echo '<td>'.reset($count).'</td>';
							echo '<td>';
							echo '<a href="projects.php?filter&type=fase&id='.$fase.'"><button class="btn btn-success btn-xs"><i class="fa fa-search"></i></button></a>';
							echo '</td>';
							echo '</tr>';
						}	
					}
				}
			}
		}
		
		// GET CANCELLED AND FINISHED PROJECTS
		public function ended()
		{
			$connect = new connection;
			if($connect->tryconnect())
			{
				$connector = $connect->getConnector();
				
				// TOTAL AMOUNT OF PROJECTS
				$totalsql = "SELECT COUNT(*) FROM TAB_projeto AS projeto INNER JOIN TAB_cc AS cliente ON projeto.id_cc = cliente.id_cc 
				WHERE projeto.id_cc=:cc AND (projeto.id_f = 5 OR projeto.id_f = 8)";
				$totalquery = $connector->prepare($totalsql);
				$totalquery->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$totalquery->execute();
				$totalcount = $totalquery->FETCH(PDO::FETCH_NUM);
				//CANCELLED AMOUNT OF PROJECTS
				$cancelsql = "SELECT COUNT(*) FROM TAB_projeto AS projeto INNER JOIN TAB_cc AS cliente ON projeto.id_cc = cliente.id_cc 
				WHERE projeto.id_cc=:cc AND projeto.id_f = 8";
				$cancelquery = $connector->prepare($cancelsql);
				$cancelquery->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$cancelquery->execute();
				$cancelcount = $cancelquery->FETCH(PDO::FETCH_NUM);
				//FINISHED AMOUNT OF PROJECTS
				$finishsql = "SELECT COUNT(*) FROM TAB_projeto AS projeto INNER JOIN TAB_cc AS cliente ON projeto.id_cc = cliente.id_cc 
				WHERE projeto.id_cc=:cc AND projeto.id_f = 5";
				$finishquery = $connector->prepare($finishsql);
				$finishquery->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$finishquery->execute();
				$finishcount = $finishquery->FETCH(PDO::FETCH_NUM);
				if(reset($totalcount)>0)
				{
					$cancelled = (reset($cancelcount) * 100) / reset($totalcount);
					$finished = (reset($finishcount) * 100) / reset($totalcount);
				}else
				{
					$cancelled = 0;
					$finished = 0;
				}
				echo '<a href="projects.php?filter&type=cf"><div class="white-panel pn donut-chart">';
				echo '	<div class="white-header">';
				echo '		<h5>Projetos Cancelados / Finalizados</h5>';
				echo '	</div>';
				echo '<div class="row">';
				echo '	<div class="col-sm-6 col-xs-6 goleft">';
				echo '		<p><i class="fa fa-check"></i> '.$finished.'% <i class="fa fa-ban"></i>'.$cancelled.'%</p>';
				echo '	</div>';
				echo '</div>';
				echo '<canvas id="serverstatus01" height="120" width="120"></canvas>';
				echo '<script>';
				echo '	var doughnutData = [';
				echo '			{';
				echo '				value: '.$finished.',';
				echo '				color:"#68dff0"';
				echo '			},';
				echo '			{';
				echo '				value : '.$cancelled.',';
				echo '				color : "#fdfdfd"';
				echo '			}';
				echo '		];';
				echo '		var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);';
				echo '</script>';
				echo '</div></a><! --/grey-panel -->';
			}
		}
		
		// GET CANCELLED AND FINISHED PROJECTS
		public function bystatus()
		{
			$connect = new connection;
			if($connect->tryconnect())
			{
				$connector = $connect->getConnector();
				
				$sqlstatus = "SELECT * from TAB_status";
				$querystatus = $connector->prepare($sqlstatus);
				$querystatus->execute();
				$rowC = $querystatus->rowCount();
				if($rowC>0)
				{
					while($resultstatus = $querystatus->FETCH(PDO::FETCH_OBJ))
					{
						$id = $resultstatus->id_status;
						$nome = $resultstatus->nome_status;
						
						// QUERY TO COUNT BY STATUS
						$sqlproject = "SELECT COUNT(*) FROM TAB_projeto AS projeto INNER JOIN TAB_status AS status ON projeto.id_status = status.id_status 
						WHERE projeto.id_cc=:cc AND projeto.id_status=:amt";
						$queryproject = $connector->prepare($sqlproject);
						$queryproject->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
						$queryproject->bindParam(':amt', $id, PDO::PARAM_STR);
						$queryproject->execute();
						$rowCproject = $queryproject->FETCH(PDO::FETCH_NUM);
						if(reset($rowCproject)>0)
						{
							echo '<tr align="left">';
							echo '	<td>'.utf8_encode($nome).'</td>';
							echo '	<td>'.reset($rowCproject).'</td>';
							echo '	<td>';
							echo '	  <a href="projects.php?filter&type=status&id='.$id.'"><button class="btn btn-success btn-xs"><i class="fa fa-search"></i></button></a>';
							echo '	</td>';
							echo '</tr>';
						}
					}
				}
			}
		}
		
		// PROJECTS PER USER
		public function usersprojects()
		{
			$connection = new connection;
			if($connection->tryconnect())
			{
				$connector = $connection->getConnector();
				
				$sqlusers = "SELECT * FROM TAB_user WHERE id_cc=:cc";
				$queryusers = $connector->prepare($sqlusers);
				$queryusers->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$queryusers->execute();
				$rowC = $queryusers->rowCount();
				if($rowC>0)
				{
					while($return_users = $queryusers->FETCH(PDO::FETCH_OBJ))
					{
						$id = $return_users->id_user;
						$nome = $return_users->nome_user;
						$sqlproject = "SELECT COUNT(*) from TAB_projeto AS projeto INNER JOIN TAB_user AS user ON projeto.id_cc = user.id_cc
						WHERE projeto.id_inmetrics_user=:user AND projeto.id_f != 5 AND projeto.id_f != 8";
						$queryproject = $connector->prepare($sqlproject);
						$queryproject->bindParam(':user', $id, PDO::PARAM_STR);
						$queryproject->execute();
						$count = $queryproject->FETCH(PDO::FETCH_NUM);
						if(reset($count)>0)
						{
							echo '<div class="bar">';
							echo '<div class="title">'.$nome.'</div>';
                            echo '<a href="myuser.php?id='.$id.'"><div class="value tooltips" data-original-title="'.reset($count).'" data-toggle="tooltip" data-placement="top">'.(reset($count) * 10).'%</div></a>';
                            echo '</div>';
						}
					}
				}
			}
		}
		
	}

?>