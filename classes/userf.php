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
			$sql = "SELECT * FROM tab_user WHERE email_in_user=:u AND senha_user=:p AND active_user = 0";
			$query = $connector->prepare($sql);
			$query->bindParam(':u', $user, PDO::PARAM_STR);
			$query->bindParam(':p', $pass, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			while($result=$query->FETCH(PDO::FETCH_OBJ))
			{
				$_SESSION['id'] = $result->id_user;
				$_SESSION['tel'] = $result->tel_user;
				$_SESSION['cc'] = $result->id_cc;
				$_SESSION['nome'] = $result->nome_user;
				$_SESSION['funcao'] = $result->funcao_user;
				$_SESSION['image'] = $result->thumbnail_user;
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
		unset($_SESSION['image']);
		unset($_SESSION['tel']);
		session_destroy();
		header('Location: index.php');
	}
	
	// get any user field
	public function getUserField($id, $field)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT $field FROM tab_user WHERE id_user=:u AND active_user = 0";
			$query = $connector->prepare($sql);
			$query->bindParam(':u', $id, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			while($result=$query->FETCH(PDO::FETCH_OBJ))
			{
				$rField = $result->$field;
			}
			return $rField;
		}
	}
	
	// TEAM MEMBERS
	public function ShowTeam()
	{
		$connect = new connection;
		
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			$sql = "SELECT * from TAB_user AS user WHERE user.id_cc=:cc AND active_user = 0";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC>0)
			{
				while($returns = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id = $returns->id_user;
					$name = $returns->nome_user;
					$image = $returns->thumbnail_user;
					$funcao = $returns->funcao_user;
					
					if(($funcao != 'Líder de Testes') && ($funcao != 'Gerente de Projetos') && ($funcao != 'Administrador'))
					{
						// NORMAL USER
						// CHECK IF IT IS AVAILABLE
						$sqlav = "SELECT COUNT(*) FROM TAB_projeto AS projeto WHERE projeto.id_inmetrics_user=:user AND projeto.id_f != 5 AND projeto.id_f != 8 AND projeto.id_cc=:cc";
						$queryav = $connector->prepare($sqlav);
						$queryav->bindParam(':user', $id, PDO::PARAM_STR);
						$queryav->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
						$queryav->execute();
						$av = $queryav->FETCH(PDO::FETCH_NUM);
						if(reset($av)>0)
						{
							echo '<a href="myuser.php?tm='.$id.'"><div class="desc">';
							echo '		<div class="thumb">';
							echo '			<img class="img-circle" src="user_thumb/'.$image.'" width="35px" height="35px" align="">';
							echo '		</div>';
							echo '		<div class="details">';
							echo '			<p>'.$name.'<br/>';
							echo '			   <muted>Atuando em '.reset($av).' projeto';if(reset($av)>1){echo 's.</muted>';}else{echo '.</muted>';}
							echo '			</p>';
							echo '		</div>';
							echo '	  </div></a>';
						}
						else
						{
							echo '<a href="myuser.php?tm='.$id.'"><div class="desc">';
							echo '		<div class="thumb">';
							echo '			<img class="img-circle" src="user_thumb/'.$image.'" width="35px" height="35px" align="">';
							echo '		</div>';
							echo '		<div class="details">';
							echo '			<p>'.$name.'<br/>';
							echo '			   <muted> Disponível </muted>';
							echo '			</p>';
							echo '		</div>';
							echo '	  </div></a>';
						}
					}
					// MANAGER USER
					else
					{
						echo '<a href="myuser.php?tm='.$id.'"><div class="desc">';
						echo '		<div class="thumb">';
						echo '			<img class="img-circle" src="user_thumb/'.$image.'" width="35px" height="35px" align="">';
						echo '		</div>';
						echo '		<div class="details">';
						echo '			<p>'.$name.'<br/>';
						echo '			   <muted>'.$funcao.'</muted>';
						echo '			</p>';
						echo '		</div>';
						echo '	  </div></a>';
					}
					
				}
			}
		}
	}
	
	// NOTIFICATIONS
	public function ShowNotifies()
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			$sql = "SELECT * FROM TAB_notify WHERE id_to_user=:cc";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['id'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC>0)
			{
				while($result=$query->FETCH(PDO::FETCH_OBJ))
				{
					$id = $result->id_notify;
					$project = $result->id_projeto;
					$status = $result->status_notify;
					$description = $result->description_notify;
					
					echo '<a href="project.php?p='.$project.'&del='.$id.'" style><div class="desc">';
					echo '	<div class="thumb">';
					echo '		<span class="badge bg-theme"><i class="fa fa-bell"></i></span>';
					echo '	</div>';
					echo '	<div class="details">';
					echo '		<p><muted>'.$status.'</muted><br/>';
					echo '		   '.$description.'<br/>';
					echo '		</p>';
					echo '	</div>';
					echo '</div></a>';
				}
			}
			else
			{
				echo '<a href="#" style><div class="desc">';
					echo '	<div class="thumb">';
					echo '		<span class="badge bg-theme"><i class="fa fa-bell"></i></span>';
					echo '	</div>';
					echo '	<div class="details">';
					echo '		<p><muted>Sem notificações</muted><br/>';
					echo '		   Não existem notificações!<br/>';
					echo '		</p>';
					echo '	</div>';
					echo '</div></a>';
			}
		}
	}
	
	// ---------------- PROJECT FUNCTIONS RELATED WITH THE USER ------------------------- //
	// USER RESPONSIBILITIES
	public function getProjects($type)
	{
		switch($type)
		{
			case "phase": self::byphase();
			break;
			case "phaseuser": self::byphasenuser();
			break;
			case "finish": self::ended();
			break;
			case "finishuser": self::endeduser();
			break;
			case "status": self::bystatus();
			break;
			case "statususer": self::bystatususer();
			break;
			default: self::usersprojects();
			break;
		}
	}
	
	// GET AMOUNT OF PROJECTS BY PHASE
	// MANAGER VIEW
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
				$limit = 0;
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
					if((reset($count)>0)&&($limit<4))
					{
						echo '<tr align="left">';
						echo '<td>'.$nome.'</td>';
						echo '<td>'.reset($count).'</td>';
						echo '<td>';
						echo '<a href="projects.php?filter&type=fase&id='.$fase.'"><button class="btn btn-success btn-xs"><i class="fa fa-search"></i></button></a>';
						echo '</td>';
						echo '</tr>';
						$limit++;
					}	
				}
			}
		}
	}
	// NORMAL USER VIEW
	public function byphasenuser()
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
				$limit = 0;
				while($result=$queryphases->FETCH(PDO::FETCH_OBJ))
				{
					$fase = $result->id_f;
					$nome = $result->nome_f;
					$sqlproject = "SELECT COUNT(*) FROM TAB_projeto AS projeto INNER JOIN TAB_cc AS cliente ON projeto.id_cc = cliente.id_cc 
					WHERE projeto.id_f != 5 AND projeto.id_f != 8 AND projeto.id_f=:f AND projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user";
					$queryproject = $connector->prepare($sqlproject);
					$queryproject->bindParam(':f', $fase, PDO::PARAM_STR);
					$queryproject->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
					$queryproject->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
					$queryproject->execute();
					$count = $queryproject->FETCH(PDO::FETCH_NUM);
					if((reset($count)>0)&&($limit<4))
					{
						echo '<tr align="left">';
						echo '<td>'.$nome.'</td>';
						echo '<td>'.reset($count).'</td>';
						echo '<td>';
						echo '<a href="projects.php?filter&type=fase&id='.$fase.'"><button class="btn btn-success btn-xs"><i class="fa fa-search"></i></button></a>';
						echo '</td>';
						echo '</tr>';
						$limit++;
					}	
				}
			}
		}
	}
	
	// GET CANCELLED AND FINISHED PROJECTS
	// MANAGER VIEW
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
	// NORMAL USER VIEW
	public function endeduser()
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			// TOTAL AMOUNT OF PROJECTS
			$totalsql = "SELECT COUNT(*) FROM TAB_projeto AS projeto INNER JOIN TAB_cc AS cliente ON projeto.id_cc = cliente.id_cc 
			WHERE projeto.id_cc=:cc AND (projeto.id_f = 5 OR projeto.id_f = 8) AND projeto.id_inmetrics_user=:user";
			$totalquery = $connector->prepare($totalsql);
			$totalquery->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$totalquery->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
			$totalquery->execute();
			$totalcount = $totalquery->FETCH(PDO::FETCH_NUM);
			//CANCELLED AMOUNT OF PROJECTS
			$cancelsql = "SELECT COUNT(*) FROM TAB_projeto AS projeto INNER JOIN TAB_cc AS cliente ON projeto.id_cc = cliente.id_cc 
			WHERE projeto.id_cc=:cc AND projeto.id_f = 8 AND projeto.id_inmetrics_user=:user";
			$cancelquery = $connector->prepare($cancelsql);
			$cancelquery->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$cancelquery->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
			$cancelquery->execute();
			$cancelcount = $cancelquery->FETCH(PDO::FETCH_NUM);
			//FINISHED AMOUNT OF PROJECTS
			$finishsql = "SELECT COUNT(*) FROM TAB_projeto AS projeto INNER JOIN TAB_cc AS cliente ON projeto.id_cc = cliente.id_cc 
			WHERE projeto.id_cc=:cc AND projeto.id_f = 5 AND projeto.id_inmetrics_user=:user";
			$finishquery = $connector->prepare($finishsql);
			$finishquery->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$finishquery->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
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
			echo '<a href="projects.php?filter&type=cf&id='.$_SESSION['id'].'"><div class="white-panel pn donut-chart">';
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
	// MANAGER VIEW
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
				$limit = 0;
				while($resultstatus = $querystatus->FETCH(PDO::FETCH_OBJ))
				{
					$id = $resultstatus->id_status;
					$nome = $resultstatus->nome_status;
					
					// QUERY TO COUNT BY STATUS
					$sqlproject = "SELECT COUNT(*) FROM TAB_projeto AS projeto INNER JOIN TAB_status AS status ON projeto.id_status = status.id_status 
					WHERE projeto.id_cc=:cc AND projeto.id_status=:amt AND projeto.id_f != 5 AND projeto.id_f != 8";
					$queryproject = $connector->prepare($sqlproject);
					$queryproject->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
					$queryproject->bindParam(':amt', $id, PDO::PARAM_STR);
					$queryproject->execute();
					$rowCproject = $queryproject->FETCH(PDO::FETCH_NUM);
					if(reset($rowCproject)>0 && ($limit<4))
					{
						echo '<tr align="left">';
						echo '	<td>'.$nome.'</td>';
						echo '	<td>'.reset($rowCproject).'</td>';
						echo '	<td>';
						echo '	  <a href="projects.php?filter&type=status&id='.$id.'"><button class="btn btn-success btn-xs"><i class="fa fa-search"></i></button></a>';
						echo '	</td>';
						echo '</tr>';
						$limit++;
					}
				}
			}
		}
	}
	// NORMAL USER VIEW
	public function bystatususer()
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
				$limit = 0;
				while($resultstatus = $querystatus->FETCH(PDO::FETCH_OBJ))
				{
					$id = $resultstatus->id_status;
					$nome = $resultstatus->nome_status;
					
					// QUERY TO COUNT BY STATUS
					$sqlproject = "SELECT COUNT(*) FROM TAB_projeto AS projeto INNER JOIN TAB_status AS status ON projeto.id_status = status.id_status 
					WHERE projeto.id_cc=:cc AND projeto.id_status=:amt AND projeto.id_inmetrics_user=:user AND projeto.id_f != 5 AND projeto.id_f != 8";
					$queryproject = $connector->prepare($sqlproject);
					$queryproject->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
					$queryproject->bindParam(':amt', $id, PDO::PARAM_STR);
					$queryproject->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
					$queryproject->execute();
					$rowCproject = $queryproject->FETCH(PDO::FETCH_NUM);
					if(reset($rowCproject)>0 && ($limit<4))
					{
						echo '<tr align="left">';
						echo '	<td>'.$nome.'</td>';
						echo '	<td>'.reset($rowCproject).'</td>';
						echo '	<td>';
						echo '	  <a href="projects.php?filter&type=status&id='.$id.'"><button class="btn btn-success btn-xs"><i class="fa fa-search"></i></button></a>';
						echo '	</td>';
						echo '</tr>';
						$limit++;
					}
				}
			}
		}
	}
	
	// YOUR PROBLEMS
	public function yourproblems($problem)
	{
		$connection = new connection;
		if($connection->tryconnect())
		{
			$connector = $connection->getConnector();
			
			switch($problem)
			{
				case "user": self::yourprojects(); self::doc(); self::schedule();
				break;
				default: self::mannager();
				break;
			}
		}
	}
	
	// YOUR PROJECTS
	// NORMAL USER VIEW
	public function yourprojects()
	{
		$connection = new connection;
		if($connection->tryconnect())
		{
			$connector = $connection->getConnector();
			
			$sql = "SELECT COUNT(*) from TAB_projeto AS projeto INNER JOIN TAB_user AS user ON projeto.id_cc = user.id_cc
					WHERE projeto.id_inmetrics_user=:user AND (projeto.id_inmetrics_user = user.id_user) AND projeto.id_f != 5 AND projeto.id_f != 8 AND user.active_user = 0";
			
			$query = $connector->prepare($sql);
			$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->FETCH(PDO::FETCH_NUM);
			echo '<a href="myprojects.php?filter&fase=andamento&id='.$_SESSION['id'].'"><div class="col-md-3 col-sm-3 col-md-offset-1 box0">';
			echo '	<div class="box1">';
			echo '		<span class="li_data"></span>';
			echo '		<h3>'.reset($rowC).'</h3>';
			echo '	</div>';
			echo '		<p>Você possui '.reset($rowC).' projetos sob sua responsabilidade</p>';
			echo '</div></a>';
		}
	}
	
	public function doc()
	{
		$connection = new connection;
		if($connection->tryconnect())
		{
			$connector = $connection->getConnector();
			$sql = "SELECT COUNT(*) from TAB_projeto AS projeto INNER JOIN TAB_user AS user ON projeto.id_cc = user.id_cc
					WHERE projeto.id_inmetrics_user=:user AND (projeto.id_inmetrics_user = user.id_user) AND projeto.id_mtp = 2 AND projeto.id_f != 5 AND projeto.id_f != 8 AND user.active_user = 0";
			
			$query = $connector->prepare($sql);
			$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->FETCH(PDO::FETCH_NUM);
			echo '<a href="myprojects.php?filter&mp=2&id='.$_SESSION['id'].'"><div class="col-md-3 col-sm-3 box0">';
			echo '	<div class="box1">';
			echo '		<span class="li_news"></span>';
			echo '		<h3>'.reset($rowC).'</h3>';
			echo '	</div>';
			echo '		<p>Existem '.reset($rowC).' projetos pendentes de recebimento de documentação.</p>';
			echo '</div></a>';
		}
	}
	
	public function schedule()
	{
		$connection = new connection;
		if($connection->tryconnect())
		{
			$connector = $connection->getConnector();
			$sql = "SELECT COUNT(*) from TAB_projeto AS projeto INNER JOIN TAB_user AS user ON projeto.id_cc = user.id_cc
					WHERE projeto.id_inmetrics_user=:user AND (projeto.id_inmetrics_user = user.id_user) AND projeto.id_mtp = 5 AND projeto.id_f != 5 AND projeto.id_f != 8 AND user.active_user = 0";
			
			$query = $connector->prepare($sql);
			$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->FETCH(PDO::FETCH_NUM);
			echo '<a href="myprojects.php?filter&mp=5&id='.$_SESSION['id'].'"><div class="col-md-3 col-sm-3 box0">';
			echo '	<div class="box1">';
			echo '		<span class="li_stack"></span>';
			echo '		<h3>'.reset($rowC).'</h3>';
			echo '	</div>';
			echo '		<p>Existem '.reset($rowC).' projetos pendentes de aprovação do cronograma.</p>';
			echo '</div></a>';
		}
	}
	// MANAGER VIEW
	public function mannager()
	{
		$connection = new connection;
		
		
		if($connection->tryconnect())
		{
			$connector = $connection->getConnector();
			
			$sql = "SELECT COUNT(*) from TAB_projeto AS projeto	WHERE projeto.id_f != 5 AND projeto.id_f != 8 AND projeto.id_cc=:cc";
			
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->FETCH(PDO::FETCH_NUM);
			echo '<a href="projects.php?filter&fase=andamento"><div class="col-md-3 col-sm-3 col-md-offset-1 box0">';
			echo '	<div class="box1">';
			echo '		<span class="li_data"></span>';
			echo '		<h3>'.reset($rowC).'</h3>';
			echo '	</div>';
			echo '		<p>Existem '.reset($rowC).' projetos em andamento</p>';
			echo '</div></a>';
		}
		
		if($connection->tryconnect())
		{
			$connector = $connection->getConnector();
			$sql = "SELECT COUNT(*) from TAB_projeto AS projeto	WHERE projeto.id_mtp = 2 AND projeto.id_cc=:cc AND projeto.id_f != 5 AND projeto.id_f != 8";
			
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->FETCH(PDO::FETCH_NUM);
			echo '<a href="projects.php?filter&mp=2"><div class="col-md-3 col-sm-3 box0">';
			echo '	<div class="box1">';
			echo '		<span class="li_news"></span>';
			echo '		<h3>'.reset($rowC).'</h3>';
			echo '	</div>';
			echo '		<p>Existem '.reset($rowC).' projetos pendentes de recebimento de documentação.</p>';
			echo '</div></a>';
		}
		
		if($connection->tryconnect())
		{
			$connector = $connection->getConnector();
			$sql = "SELECT COUNT(*) from TAB_projeto AS projeto WHERE projeto.id_mtp = 5 AND projeto.id_cc=:cc AND projeto.id_f != 5 AND projeto.id_f != 8";
			
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->FETCH(PDO::FETCH_NUM);
			echo '<a href="projects.php?filter&mp=5"><div class="col-md-3 col-sm-3 box0">';
			echo '	<div class="box1">';
			echo '		<span class="li_stack"></span>';
			echo '		<h3>'.reset($rowC).'</h3>';
			echo '	</div>';
			echo '		<p>Existem '.reset($rowC).' projetos pendentes de aprovação do cronograma.</p>';
			echo '</div></a>';
		}
	}
	// END PROBLEMS
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
					WHERE projeto.id_inmetrics_user=:user AND (projeto.id_inmetrics_user = user.id_user) AND projeto.id_f != 5 AND projeto.id_f != 8 AND user.active_user = 0";
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
	
	public function getUsers()
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			$sql = "SELECT user.id_user AS ID, user.nome_user AS Nome, user.email_in_user AS Email, centroc.desc_cc AS CentroCusto, user.funcao_user AS Funcao 
			FROM TAB_user AS user 
			INNER JOIN TAB_cc AS centroc ON user.id_cc=centroc.id_cc 
			WHERE user.id_cc=:cc AND user.id_user != :myuser AND user.active_user = 0";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->bindParam(':myuser', $_SESSION['id'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id = $result->ID;
					$nome = $result->Nome;
					$email = $result->Email;
					$centrocusto = $result->CentroCusto;
					$funcao_user = $result->Funcao;
					
					echo '<tr>
							  <td class="numeric">'.$id.'</td>
							  <td>'.$nome.'</td>
							  <td>'.$email.'</td>
							  <td>'.$centrocusto.'</td>
							  <td>'.$funcao_user.'</td>
							  <td>
								<a data-toggle="modal" href="myuser.php?edit='.$id.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
								<a data-toggle="modal" href="manageusers.php#cancelamento'.$id.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
							  </td>
						  </tr>';
				}
			}
		}
	}
	
	public function getUsersDeleteModal()
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			$sql = "SELECT user.id_user AS ID FROM TAB_user AS user 
			INNER JOIN TAB_cc AS centroc ON user.id_cc=centroc.id_cc 
			WHERE user.id_cc=:cc AND user.id_user != :myuser AND user.active_user = 0";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->bindParam(':myuser', $_SESSION['id'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id = $result->ID;					
					echo '<!-- Modal cancelamento-->
							<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="cancelamento'.$id.'" class="modal fade">
								<form method="get" action="">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Tem certeza que deseja desativar o usuário?</h4>
												<input id="id" name="id" type="hidden" value="'.$id.'">
											</div>
											<div class="modal-footer">
												<button data-dismiss="modal" class="btn btn-default" type="button">Não</button>
												<button href="index.php#cancelado" class="btn btn-theme" type="submit" name="delete">Sim</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						<!-- modal -->';
				}
			}
		}
	}
	
	public function DeleteUser($id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			$sql = "UPDATE TAB_user SET active_user=1 WHERE id_user=:user";
			$query = $connector->prepare($sql);
			$query->bindParam(':user', $id, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC>0)
			{
				echo '<script>alert("Usuário desativado com sucesso!"); window.location.href = "manageusers.php";</script>';
			}
			else
			{
				echo '<script>alert("Erro ao desativar usuário!"); window.location.href = "manageusers.php";</script>';
			}
		}
	}
	
	// UPLOAD IMAGE
	public function UploadImage($id, $cc, $name, $funcao, $tel, $email, $pass1, $new_name_thumb, $tmp_thumb, $path_thumb, $type)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			// 0 = INSERT NEW IMAGE
			// 1 = UPDATE IMAGE
			if($type == 0)
			{
				if(move_uploaded_file($tmp_thumb, $path_thumb))
				{
					self::SetUserData($id, $cc, $name, $funcao, $tel, $email, $pass1, $new_name_thumb, $type);
				}
				else
				{
					echo '<script>alert("Erro ao efetuar upload de imagens!"); window.location.href = "myuser.php?edit='.$id.'";</script>';
				}
			}
			// UPDATE IMAGE USER || DELETE THE OLDER VERSION BEFORE SEND THE NEW ONE
			else
			{
				$sql = "SELECT thumbnail_user AS Thumbnail FROM TAB_user WHERE id_user=:user";
				$query = $connector->prepare($sql);
				$query->bindParam('user', $id, PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC == 1)
				{
					while($result = $query->FETCH(PDO::FETCH_OBJ))
					{
						$old_image = "user_thumb/".$result->Thumbnail;
						if($old_image != "user_thumb/")
						{
							// DELETE THE OLDER IMAGE
							chmod($old_image, 0777);
							if(unlink($old_image))
							{
								// UPLOAD THE NEW IMAGE
								if(move_uploaded_file($tmp_thumb, $path_thumb))
								{
									self::SetUserData($id, $cc, $name, $funcao, $tel, $email, $pass1, $new_name_thumb, $type);
								}
							}
							// FAILED TO UNLINK OLDER THUMBNAIL
							else
							{
								echo '<script>alert("Erro ao efetuar upload de imagens!"); window.location.href = "myuser.php?edit='.$id.'";</script>';
							}
						}
						else
						{
							// UPLOAD THE NEW IMAGE
							if(move_uploaded_file($tmp_thumb, $path_thumb))
							{
								self::SetUserData($id, $cc, $name, $funcao, $tel, $email, $pass1, $new_name_thumb, $type);
							}
						}
						
					}
				}
			}
		}
	}
	
	// SET USER DATA
	public function SetUserData($id, $cc, $name, $funcao, $tel, $email, $pass1, $new_name_thumb, $type)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			// IF INSERT
			if($type == 0)
			{
				$sql = "INSERT INTO TAB_user(id_cc, nome_user, funcao_user, tel_user, email_in_user, senha_user, thumbnail_user) VALUES(:cc, :name, :funcao, :tel, :mail, :pass, :thumb)";
				$query = $connector->prepare($sql);
				$query->bindParam(':cc', $cc, PDO::PARAM_STR);
				$query->bindParam(':name', $name, PDO::PARAM_STR);
				$query->bindParam(':funcao', $funcao, PDO::PARAM_STR);
				$query->bindParam(':tel', $tel, PDO::PARAM_STR);
				$query->bindParam(':mail', $email, PDO::PARAM_STR);
				$query->bindParam(':pass', $pass1, PDO::PARAM_STR);
				$query->bindParam(':thumb', $new_name_thumb, PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC>0)
				{
					echo '<script>alert("Usuário inserido com sucesso!"); window.location.href = "manageusers.php";</script>';
				}
				else
				{
					echo '<script>alert("Erro ao inserir usuário!"); window.location.href = "manageusers.php";</script>';
				}
			}
			// IF UPDATE OTHER USER
			else if($type == 1)
			{
				$sql = "UPDATE TAB_user SET id_cc=:cc, nome_user=:user, funcao_user=:funcao, tel_user=:tel, email_in_user=:mail, senha_user=:pass, thumbnail_user=:thumb WHERE id_user=:id";
				$query = $connector->prepare($sql);
				$query->bindParam(':cc', $cc, PDO::PARAM_STR);
				$query->bindParam(':user', $name, PDO::PARAM_STR);
				$query->bindParam(':funcao', $funcao, PDO::PARAM_STR);
				$query->bindParam(':tel', $tel, PDO::PARAM_STR);
				$query->bindParam(':mail', $email, PDO::PARAM_STR);
				$query->bindParam(':pass', $pass1, PDO::PARAM_STR);
				$query->bindParam(':thumb', $new_name_thumb, PDO::PARAM_STR);
				$query->bindParam(':id', $id, PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC>0)
				{
					echo '<script>alert("Usuário alterado com sucesso!"); window.location.href = "manageusers.php";</script>';
				}
				else
				{
					echo '<script>alert("Erro ao alterar usuário!"); window.location.href = "manageusers.php";</script>';
				}
			}
			else
			{
				// IF UPDATE MY OWN USER
				
				$sql = "UPDATE TAB_user SET id_cc=:cc, nome_user=:user, funcao_user=:funcao, tel_user=:tel, email_in_user=:mail, senha_user=:pass, thumbnail_user=:thumb WHERE id_user=:id";
				$query = $connector->prepare($sql);
				$query->bindParam(':cc', $cc, PDO::PARAM_STR);
				$query->bindParam(':user', $name, PDO::PARAM_STR);
				$query->bindParam(':funcao', $funcao, PDO::PARAM_STR);
				$query->bindParam(':tel', $tel, PDO::PARAM_STR);
				$query->bindParam(':mail', $email, PDO::PARAM_STR);
				$query->bindParam(':pass', $pass1, PDO::PARAM_STR);
				$query->bindParam(':thumb', $new_name_thumb, PDO::PARAM_STR);
				$query->bindParam(':id', $id, PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC>0)
				{
					echo '<script>alert("Usuário alterado com sucesso!"); window.location.href = "myuser.php";</script>';
				}
				else
				{
					echo '<script>alert("Erro ao alterar usuário!"); window.location.href = "myuser.php";</script>';
				}
			}
		}
		
	}
}

?>