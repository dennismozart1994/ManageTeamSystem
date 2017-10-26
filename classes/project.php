<?php
require_once('connection.php');
require_once('parameters.php');
require_once('notify.php');

class projects
{
	public function getProjects($type)
	{
		switch($type)
		{
			case "normaluser": self::showmyprojects();
			break;
			default: self::manage();
			break;
		}
	}
	
	public function ApplyFilter($user, $phase, $projectname, $lvl)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			if($lvl == 0)
			{
				$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
				ltm.nome_lc AS NomeLiderTestes, 
				lp.nome_lp AS NomeLiderProjetos, 
				user.nome_user AS NomeAnalista, 
				fases.nome_f AS NomeFase,
				status.nome_status AS NomeStatus,
				mot_pend.nome_mtp AS NomeMotivo 
				FROM tab_projeto AS projeto 
				INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
				INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
				INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
				INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
				INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
				INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
				WHERE projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user AND projeto.id_f=:phase AND nmp_prj LIKE CONCAT('%',:projectname,'%')";
				$query = $connector->prepare($sql);
				$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$query->bindParam(':user', $user, PDO::PARAM_STR);
				$query->bindParam(':phase', $phase, PDO::PARAM_STR);
				$query->bindParam(':projectname', $projectname, PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC > 0)
				{
					while($result = $query->FETCH(PDO::FETCH_OBJ))
					{
						$idprojeto = $result->ID;
						$id_phase = $result->ID_fase;
						$ts = $result->TS;
						$nomeprojeto = $result->NomeProjeto;
						$ltm = $result->NomeLiderTestes;
						$lp = $result->NomeLiderProjetos;
						$analista = $result->NomeAnalista;
						$fase = $result->NomeFase;
						$status = $result->NomeStatus;
						$pendencia = $result->NomeMotivo;
						echo '		<tr>';
						echo '			  <td class="numeric">'.$ts.'</td>';
						echo '			  <td>'.$nomeprojeto.'</td>';
						echo '			  <td>'.$ltm.'</td>';
						echo '			  <td>'.$lp.'</td>';
						echo '			  <td>'.$analista.'</td>';
						echo '			  <td>'.$fase.'</td>';
						echo '			  <td>'.$status.'</td>';
						echo '			  <td>'.$pendencia.'</td>';
						echo '			  <td>';
						if(($id_phase != 5) && ($id_phase != 8))
						{
							echo '				<a data-toggle="modal" href="myprojects.php#myModal'.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
							echo '				<a data-toggle="modal" href="myprojects.php#encerramento'.$idprojeto.'"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></a>';
							echo '				<a data-toggle="modal" href="myprojects.php#cancelamento'.$idprojeto.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>';
						}
							echo '				<a href="project.php?p='.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>';
							echo '			  </td>';
						echo '		</tr>';
					}
				}
			}
			else
			{
				$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
				ltm.nome_lc AS NomeLiderTestes, 
				lp.nome_lp AS NomeLiderProjetos, 
				user.nome_user AS NomeAnalista, 
				fases.nome_f AS NomeFase,
				status.nome_status AS NomeStatus,
				mot_pend.nome_mtp AS NomeMotivo 
				FROM tab_projeto AS projeto 
				INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
				INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
				INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
				INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
				INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
				INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
				WHERE projeto.id_cc=:cc AND projeto.id_f=:phase AND nmp_prj LIKE CONCAT('%',:projectname,'%')";
				$query = $connector->prepare($sql);
				$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$query->bindParam(':phase', $phase, PDO::PARAM_STR);
				$query->bindParam(':projectname', $projectname, PDO::PARAM_STR);
				
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC > 0)
				{
					while($result = $query->FETCH(PDO::FETCH_OBJ))
					{
						$idprojeto = $result->ID;
						$id_phase = $result->ID_fase;
						$ts = $result->TS;
						$nomeprojeto = $result->NomeProjeto;
						$ltm = $result->NomeLiderTestes;
						$lp = $result->NomeLiderProjetos;
						$analista = $result->NomeAnalista;
						$fase = $result->NomeFase;
						$status = $result->NomeStatus;
						$pendencia = $result->NomeMotivo;
						echo '		<tr>';
						echo '			  <td class="numeric">'.$ts.'</td>';
						echo '			  <td>'.$nomeprojeto.'</td>';
						echo '			  <td>'.$ltm.'</td>';
						echo '			  <td>'.$lp.'</td>';
						echo '			  <td>'.$analista.'</td>';
						echo '			  <td>'.$fase.'</td>';
						echo '			  <td>'.$status.'</td>';
						echo '			  <td>'.$pendencia.'</td>';
						echo '			  <td>';
						if(($id_phase != 5) && ($id_phase != 8))
						{
							echo '				<a data-toggle="modal" href="projects.php#myModal'.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
							echo '				<a data-toggle="modal" href="projects.php#encerramento'.$idprojeto.'"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></a>';
							echo '				<a data-toggle="modal" href="projects.php#cancelamento'.$idprojeto.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>';
						}
						echo '				<a href="project.php?p='.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>';
						echo '			  </td>';
						echo '		</tr>';
					}
				}
			}
		}
	}
	
	public function getFProjects($type, $id, $lvl)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			// 0 - Normal USER
			// 1 - Admin User
			if($lvl = 0)
			{
				// filter by projects running
				if(($type == "fase") && ($id == "andamento"))
				{
					$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
					ltm.nome_lc AS NomeLiderTestes, 
					lp.nome_lp AS NomeLiderProjetos, 
					user.nome_user AS NomeAnalista, 
					fases.nome_f AS NomeFase,
					status.nome_status AS NomeStatus,
					mot_pend.nome_mtp AS NomeMotivo 
					FROM tab_projeto AS projeto 
					INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
					INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
					INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
					INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
					INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
					INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
					WHERE projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user AND projeto.id_f !=5 AND projeto.id_f !=8";
					$query = $connector->prepare($sql);
					$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
					$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
				}
				// filter by finished projects
				else if(($type == "cf"))
				{
					$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
					ltm.nome_lc AS NomeLiderTestes, 
					lp.nome_lp AS NomeLiderProjetos, 
					user.nome_user AS NomeAnalista, 
					fases.nome_f AS NomeFase,
					status.nome_status AS NomeStatus,
					mot_pend.nome_mtp AS NomeMotivo 
					FROM tab_projeto AS projeto 
					INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
					INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
					INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
					INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
					INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
					INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
					WHERE projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user AND (projeto.id_f = 5 OR projeto.id_f = 8)";
					$query = $connector->prepare($sql);
					$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
					$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
				}
				// filter by projects running and specific phase
				else if(($type == "fase") && ($id != "andamento"))
				{
					$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
					ltm.nome_lc AS NomeLiderTestes, 
					lp.nome_lp AS NomeLiderProjetos, 
					user.nome_user AS NomeAnalista, 
					fases.nome_f AS NomeFase,
					status.nome_status AS NomeStatus,
					mot_pend.nome_mtp AS NomeMotivo 
					FROM tab_projeto AS projeto 
					INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
					INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
					INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
					INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
					INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
					INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
					WHERE projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user AND projeto.id_f=:phase";
					$query = $connector->prepare($sql);
					$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
					$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
					$query->bindParam(':phase', $id, PDO::PARAM_STR);
				}
				// filter by status
				else if(($type == "status"))
				{
					$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
					ltm.nome_lc AS NomeLiderTestes, 
					lp.nome_lp AS NomeLiderProjetos, 
					user.nome_user AS NomeAnalista, 
					fases.nome_f AS NomeFase,
					status.nome_status AS NomeStatus,
					mot_pend.nome_mtp AS NomeMotivo 
					FROM tab_projeto AS projeto 
					INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
					INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
					INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
					INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
					INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
					INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
					WHERE projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user AND projeto.id_status=:status";
					$query = $connector->prepare($sql);
					$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
					$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
					$query->bindParam(':status', $id, PDO::PARAM_STR);
				}
				// filter by delay reason
				else
				{
					$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
					ltm.nome_lc AS NomeLiderTestes, 
					lp.nome_lp AS NomeLiderProjetos, 
					user.nome_user AS NomeAnalista, 
					fases.nome_f AS NomeFase,
					status.nome_status AS NomeStatus,
					mot_pend.nome_mtp AS NomeMotivo 
					FROM tab_projeto AS projeto 
					INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
					INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
					INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
					INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
					INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
					INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
					WHERE projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user AND projeto.id_mtp=:pendency";
					$query = $connector->prepare($sql);
					$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
					$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
					$query->bindParam(':pendency', $id, PDO::PARAM_STR);
				}
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC > 0)
				{
					while($result = $query->FETCH(PDO::FETCH_OBJ))
					{
						$idprojeto = $result->ID;
						$id_phase = $result->ID_fase;
						$ts = $result->TS;
						$nomeprojeto = $result->NomeProjeto;
						$ltm = $result->NomeLiderTestes;
						$lp = $result->NomeLiderProjetos;
						$analista = $result->NomeAnalista;
						$fase = $result->NomeFase;
						$status = $result->NomeStatus;
						$pendencia = $result->NomeMotivo;
						echo '		<tr>';
						echo '			  <td class="numeric">'.$ts.'</td>';
						echo '			  <td>'.$nomeprojeto.'</td>';
						echo '			  <td>'.$ltm.'</td>';
						echo '			  <td>'.$lp.'</td>';
						echo '			  <td>'.$analista.'</td>';
						echo '			  <td>'.$fase.'</td>';
						echo '			  <td>'.$status.'</td>';
						echo '			  <td>'.$pendencia.'</td>';
						echo '			  <td>';
						if(($id_phase != 5) && ($id_phase != 8))
						{
							echo '				<a data-toggle="modal" href="myprojects.php#myModal'.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
							echo '				<a data-toggle="modal" href="myprojects.php#encerramento'.$idprojeto.'"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></a>';
							echo '				<a data-toggle="modal" href="myprojects.php#cancelamento'.$idprojeto.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>';
						}
							echo '				<a href="project.php?p='.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>';
											echo '			  </td>';
						echo '		</tr>';
					}
				}
			}
			// Admin USER
			if($lvl = 1)
			{
				// filter by projects running
				if(($type == "fase") && ($id == "andamento"))
				{
					$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
					ltm.nome_lc AS NomeLiderTestes, 
					lp.nome_lp AS NomeLiderProjetos, 
					user.nome_user AS NomeAnalista, 
					fases.nome_f AS NomeFase,
					status.nome_status AS NomeStatus,
					mot_pend.nome_mtp AS NomeMotivo 
					FROM tab_projeto AS projeto 
					INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
					INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
					INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
					INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
					INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
					INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
					WHERE projeto.id_cc=:cc AND projeto.id_f !=5 AND projeto.id_f !=8";
					$query = $connector->prepare($sql);
					$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				}
				// filter by finished projects
				else if(($type == "cf"))
				{
					$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
					ltm.nome_lc AS NomeLiderTestes, 
					lp.nome_lp AS NomeLiderProjetos, 
					user.nome_user AS NomeAnalista, 
					fases.nome_f AS NomeFase,
					status.nome_status AS NomeStatus,
					mot_pend.nome_mtp AS NomeMotivo 
					FROM tab_projeto AS projeto 
					INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
					INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
					INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
					INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
					INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
					INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
					WHERE projeto.id_cc=:cc AND (projeto.id_f = 5 OR projeto.id_f = 8)";
					$query = $connector->prepare($sql);
					$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				}
				// filter by projects running and specific phase
				else if(($type == "fase") && ($id != "andamento"))
				{
					$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
					ltm.nome_lc AS NomeLiderTestes, 
					lp.nome_lp AS NomeLiderProjetos, 
					user.nome_user AS NomeAnalista, 
					fases.nome_f AS NomeFase,
					status.nome_status AS NomeStatus,
					mot_pend.nome_mtp AS NomeMotivo 
					FROM tab_projeto AS projeto 
					INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
					INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
					INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
					INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
					INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
					INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
					WHERE projeto.id_cc=:cc AND projeto.id_f=:phase";
					$query = $connector->prepare($sql);
					$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
					$query->bindParam(':phase', $id, PDO::PARAM_STR);
				}
				// filter by status
				else if(($type == "status"))
				{
					$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
					ltm.nome_lc AS NomeLiderTestes, 
					lp.nome_lp AS NomeLiderProjetos, 
					user.nome_user AS NomeAnalista, 
					fases.nome_f AS NomeFase,
					status.nome_status AS NomeStatus,
					mot_pend.nome_mtp AS NomeMotivo 
					FROM tab_projeto AS projeto 
					INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
					INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
					INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
					INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
					INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
					INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
					WHERE projeto.id_cc=:cc AND projeto.id_status=:status";
					$query = $connector->prepare($sql);
					$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
					$query->bindParam(':status', $id, PDO::PARAM_STR);
				}
				// filter by delay reason
				else
				{
					$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
					ltm.nome_lc AS NomeLiderTestes, 
					lp.nome_lp AS NomeLiderProjetos, 
					user.nome_user AS NomeAnalista, 
					fases.nome_f AS NomeFase,
					status.nome_status AS NomeStatus,
					mot_pend.nome_mtp AS NomeMotivo 
					FROM tab_projeto AS projeto 
					INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
					INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
					INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
					INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
					INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
					INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
					WHERE projeto.id_cc=:cc AND projeto.id_mtp=:pendency";
					$query = $connector->prepare($sql);
					$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
					$query->bindParam(':pendency', $id, PDO::PARAM_STR);
				}
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC > 0)
				{
					while($result = $query->FETCH(PDO::FETCH_OBJ))
					{
						$idprojeto = $result->ID;
						$id_phase = $result->ID_fase;
						$ts = $result->TS;
						$nomeprojeto = $result->NomeProjeto;
						$ltm = $result->NomeLiderTestes;
						$lp = $result->NomeLiderProjetos;
						$analista = $result->NomeAnalista;
						$fase = $result->NomeFase;
						$status = $result->NomeStatus;
						$pendencia = $result->NomeMotivo;
						echo '		<tr>';
						echo '			  <td class="numeric">'.$ts.'</td>';
						echo '			  <td>'.$nomeprojeto.'</td>';
						echo '			  <td>'.$ltm.'</td>';
						echo '			  <td>'.$lp.'</td>';
						echo '			  <td>'.$analista.'</td>';
						echo '			  <td>'.$fase.'</td>';
						echo '			  <td>'.$status.'</td>';
						echo '			  <td>'.$pendencia.'</td>';
						echo '			  <td>';
						if(($id_phase != 5) && ($id_phase != 8))
						{
							echo '				<a data-toggle="modal" href="projects.php#myModal'.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
							echo '				<a data-toggle="modal" href="projects.php#encerramento'.$idprojeto.'"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></a>';
							echo '				<a data-toggle="modal" href="projects.php#cancelamento'.$idprojeto.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>';
						}
						echo '				<a href="project.php?p='.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>';
						echo '			  </td>';
						echo '		</tr>';
					}
				}
			}
		}
		
	}
	
	public function showFmyprojects($id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
			ltm.nome_lc AS NomeLiderTestes, 
			lp.nome_lp AS NomeLiderProjetos, 
			user.nome_user AS NomeAnalista, 
			fases.nome_f AS NomeFase,
			status.nome_status AS NomeStatus,
			mot_pend.nome_mtp AS NomeMotivo 
			FROM tab_projeto AS projeto 
			INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
			INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
			INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
			INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
			INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
			INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
			WHERE projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user AND projeto.id_f =:id";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
			$query->bindParam(':user', $id, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$idprojeto = $result->ID;
					$id_phase = $result->ID_fase;
					$ts = $result->TS;
					$nomeprojeto = $result->NomeProjeto;
					$ltm = $result->NomeLiderTestes;
					$lp = $result->NomeLiderProjetos;
					$analista = $result->NomeAnalista;
					$fase = $result->NomeFase;
					$status = $result->NomeStatus;
					$pendencia = $result->NomeMotivo;
					echo '		<tr>';
					echo '			  <td class="numeric">'.$ts.'</td>';
					echo '			  <td>'.$nomeprojeto.'</td>';
					echo '			  <td>'.$ltm.'</td>';
					echo '			  <td>'.$lp.'</td>';
					echo '			  <td>'.$analista.'</td>';
					echo '			  <td>'.$fase.'</td>';
					echo '			  <td>'.$status.'</td>';
					echo '			  <td>'.$pendencia.'</td>';
					echo '			  <td>';
					if(($id_phase != 5) && ($id_phase != 8))
					{
						echo '				<a data-toggle="modal" href="myprojects.php#myModal'.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
						echo '				<a data-toggle="modal" href="myprojects.php#encerramento'.$idprojeto.'"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></a>';
						echo '				<a data-toggle="modal" href="myprojects.php#cancelamento'.$idprojeto.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>';
					}
						echo '				<a href="project.php?p='.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>';
										echo '			  </td>';
					echo '		</tr>';
				}
			}
		}
	}
	
	
	// --------------------- INSERT, UPDATE AND DELETE DATA FROM DATABASE --------------------------//
	public function InsertProject($id, $projectname, $ltm, $lp, $respInmetrics, $phase, $status, $pendency, $doc, $meeting, $mrr, $schedule, $approvement)
	{
		$connect = new connection;
		$notify = new notify;
		
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "INSERT INTO 
			tab_projeto(ts_prj, nmp_prj, id_cc, id_lc, id_lp, id_user, id_inmetrics_user, id_f, id_status, id_mtp, doc_prj, reu_prj, mrr_prj, crono_prj, aprv_prj) 
			VALUES(:ts, :name, :client, :ltm, :lp, :user, :responsable, :phase, :status, :pendency, :doc, :meeting, :mrr, :schedule, :approvement)";
			$query = $connector->prepare($sql);
			$query->bindParam(':ts', $id, PDO::PARAM_STR);
			$query->bindParam(':name', $projectname, PDO::PARAM_STR);
			$query->bindParam(':client', $_SESSION['cc'], PDO::PARAM_STR);
			$query->bindParam(':ltm', $ltm, PDO::PARAM_STR);
			$query->bindParam(':lp', $lp, PDO::PARAM_STR);
			$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
			$query->bindParam(':responsable', $respInmetrics, PDO::PARAM_STR);
			$query->bindParam(':phase', $phase, PDO::PARAM_STR);
			$query->bindParam(':status', $status, PDO::PARAM_STR);
			$query->bindParam(':pendency', $pendency, PDO::PARAM_STR);
			$query->bindParam(':doc', $doc, PDO::PARAM_STR);
			$query->bindParam(':meeting', $meeting, PDO::PARAM_STR);
			$query->bindParam(':mrr', $mrr, PDO::PARAM_STR);
			$query->bindParam(':schedule', $schedule, PDO::PARAM_STR);
			$query->bindParam(':approvement', $approvement, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC>0)
			{
				$projectid = $connector->lastInsertId();
				$status = "Novo projeto!";
				$message = "Você possui um novo projeto sob sua responsabilidade!";
				
				$historyinsert = "INSERT INTO tab_historico(data_hst, id_f, prvt_hst, rlzd_hst, desc_hst, id_prj, id_user) 
				VALUES(NOW(), :phase, 100, 0, 'Projeto recebido para estimativa de custos', :project, :user)";
				$queryhst = $connector->prepare($historyinsert);
				$queryhst->bindParam(':phase', $phase, PDO::PARAM_STR);
				$queryhst->bindParam(':project', $projectid, PDO::PARAM_STR);
				$queryhst->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
				$queryhst->execute();
				$count = $queryhst->rowCount();
				if($count>0)
				{
					$notify->AddNotify($projectid, $_SESSION['id'], $respInmetrics, $status, $message);
				}
			}
		}
	}
	
	// UPDATE PROJECT INFO
	public function UpdateProjectInfo($id, $ltm, $lp, $analyst, $phase, $status, $pendency, $doc, $meeting, $mrr, $schedule, $approvement)
	{
		$connect = new connection;
		
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			$sql = "UPDATE tab_projeto SET id_lc=:ltm, id_lp=:lp, id_inmetrics_user=:analyst, id_f=:phase, id_status=:status, id_mtp=:pendency, doc_prj=:doc, reu_prj=:meeting, 
			mrr_prj=:mrr, crono_prj=:schedule, aprv_prj=:approvement WHERE id_prj=:prjid";
			$query = $connector->prepare($sql);
			$query->bindParam(':ltm', $ltm, PDO::PARAM_INT);
			$query->bindParam(':lp', $lp, PDO::PARAM_INT);
			$query->bindParam(':analyst', $analyst, PDO::PARAM_INT);
			$query->bindParam(':phase', $phase, PDO::PARAM_INT);
			$query->bindParam(':status', $status, PDO::PARAM_INT);
			$query->bindParam(':pendency', $pendency, PDO::PARAM_INT);
			$query->bindParam(':doc', $doc, PDO::PARAM_INT);
			$query->bindParam(':meeting', $meeting, PDO::PARAM_INT);
			$query->bindParam(':mrr', $mrr, PDO::PARAM_INT);
			$query->bindParam(':schedule', $schedule, PDO::PARAM_INT);
			$query->bindParam(':approvement', $approvement, PDO::PARAM_INT);
			$query->bindParam(':prjid', $id, PDO::PARAM_INT);
			self::addHistoryNote(date('Y-m-d', time()), $phase, 0, 0, 'Alteração de dados/fase do projeto', $id, $_SESSION['id']);
			if($query->execute())
			{
				echo '<script>alert("Dados atualizados com sucesso!"); window.location.href = "project.php?p='.$id.'"</script>';
			}
		}
	}
	
	// ----------------------------------- USER VIEW ----------------------------------------------//
	
	// Get project info
	public function getInfo($id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.doc_prj AS AnaliseDOC, 
			projeto.reu_prj AS Reuniao, projeto.mrr_prj AS MRR, projeto.crono_prj AS Cronograma, projeto.aprv_prj AS Aprovado, 
			ltm.id_lc AS ID_LTM, ltm.nome_lc AS NomeLiderTestes, 
			lp.id_lp AS ID_LP, lp.nome_lp AS NomeLiderProjetos, 
			user.id_user AS ID_Analista, user.nome_user AS NomeAnalista, 
			fases.id_f AS ID_fase, fases.nome_f AS NomeFase, 
			status.id_status AS ID_Status, status.nome_status AS NomeStatus, 
			mot_pend.id_mtp AS ID_Pendencia, mot_pend.nome_mtp AS NomeMotivo,  
			historico.prvt_hst AS Previsto, historico.rlzd_hst AS Realizado 
			FROM tab_projeto AS projeto 
			INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
			INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
			INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
			INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
			INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
			INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
			INNER JOIN tab_historico AS historico ON historico.id_prj = projeto.id_prj 
			WHERE projeto.id_cc=:cc AND projeto.id_prj=:proj AND historico.id_hst = (SELECT MAX(historico.id_hst) from tab_historico AS historico WHERE id_prj=:idprj)"; 
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->bindParam(':proj', $id, PDO::PARAM_STR);
			$query->bindParam(':idprj', $id, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC == 1)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id = $result->ID;
					$ts = $result->TS;
					$nome = $result->NomeProjeto;
					$doc = $result->AnaliseDOC;
					$reuniao = $result->Reuniao;
					$mrr = $result->MRR;
					$cronograma = $result->Cronograma;
					$aprovacao = $result->Aprovado;
					$ltm = $result->NomeLiderTestes;
					$id_ltm = $result->ID_LTM;
					$lp = $result->NomeLiderProjetos;
					$id_lp = $result->ID_LP;
					$analista = $result->NomeAnalista;
					$id_analista = $result->ID_Analista;
					$fase = $result->NomeFase;
					$id_f = $result->ID_fase;
					$status = $result->NomeStatus;
					$id_status = $result->ID_Status;
					$pendencia = $result->NomeMotivo;
					$id_pendencia = $result->ID_Pendencia;
					$previsto = $result->Previsto;
					$realizado = $result->Realizado;
					if(($id_f != 5) && ($id_f != 8)){$interact = "";}else{$interact = "disabled";}
					echo '<div class="form-group">
                              <label class="col-lg-12 col-sm-12 control-label"><h4>Líderes</h4></label>
                              <div class="col-lg-3">
                                  <p class="form-control-static"><b>Testes e Mudanças:</b></p>
								  <select class="form-control" name="ltm" '.$interact.'>
									  <option value="'.$id_ltm.'">'.$ltm.'</option>';
									  // OTHERS LTM
										$lc = new parameters;
										$lc->getLTM("select", $id_ltm);
					echo '		  </select>
                              </div>
							  <div class="col-lg-3">
                                  <p class="form-control-static"><b>Projeto Rede:</b></p>
								  <select class="form-control" name="lp" '.$interact.'>
									  <option value="'.$id_lp.'">'.$lp.'</option>';
									// OTHERS LP
									$lp = new parameters;
									$lp->getLP("select", $id_lp);
					echo '		  </select>
                              </div>
							   <div class="col-lg-4">
                                  <p class="form-control-static"><b>Responsável Inmetrics:</b></p>
								  <select class="form-control" name="analyst" '.$interact.'>
									  <option value="'.$id_analista.'">'.$analista.'</option>';
									  // OTHERS ANALYST
									  $analyst = new parameters;
									  $analyst->getAnalyst("select", $id_analista);
					echo '		  </select>
                              </div>
                          </div>';
						  
					echo '<div class="form-group">
                              <label class="col-lg-12 col-sm-12 control-label"><h4>Andamento</h4></label>
                              <div class="col-lg-3">
                                  <p class="form-control-static"><b>Fase:</b></p>
								  <select class="form-control" name="phase" '.$interact.'>
									  <option value="'.$id_f.'">'.$fase.'</option>';
									  // OTHERS ANALYST
									  $phase = new parameters;
									  $phase->getPhases("select", $id_f);
					echo 		  '</select>
                              </div>
							  <div class="col-lg-3">
                                  <p class="form-control-static"><b>Status:</b></p>
								  <select class="form-control" name="status" '.$interact.'>
									  <option value="'.$id_status.'">'.$status.'</option>';
									  // OTHERS STATUS
									  $phase = new parameters;
									  $phase->getStatus("select", $id_status);
					echo '		  </select>
                              </div>
							   <div class="col-lg-4">
                                  <p class="form-control-static"><b>Motivo da pendência</b></p>
								  <select class="form-control" name="pendency" '.$interact.'>
									  <option value="'.$id_pendencia.'">'.$pendencia.'</option>';
									 // PENDING
									  $phase = new parameters;
									  $phase->getPendencia("select", $id_pendencia); 
					echo   '  	  </select>
                              </div>
                          </div>';
					// ------------------- BASIC CHECKLIST ----------------------------/ 
					echo '<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label"><h4>Checklist Inicial</h4></label>
                              <div class="col-lg-2">
                                    <p class="form-control-static"><b>Análise de doc(s)?</b></p>
								    <select class="form-control" name="doc" '.$interact.'>
									  <option value="'.$doc.'">';
										  if($doc == 1)
											{
											  echo "Sim</option>";
											  echo "<option value='0'>Não</option>";
											}
											else
											{
											  echo "Não</option>";
											  echo "<option value='1'>Sim</option>";
											}
					echo '			</select>';
                    echo '    </div>
							  <div class="col-lg-2">
                                  <p class="form-control-static"><b>Reunião?</b></p>
								  <select class="form-control" name="meeting" '.$interact.'>
									  <option value="'.$reuniao.'">';
										  if($reuniao == 1)
											{
											  echo "Sim</option>";
											  echo "<option value='0'>Não</option>";
											}
											else
											{
											  echo "Não</option>";
											  echo "<option value='1'>Sim</option>";
											}
					echo '		  </select>';
					echo '    </div>
							  <div class="col-lg-2">
                                  <p class="form-control-static"><b>MRR?</b></p>
								  <select class="form-control" name="mrr" '.$interact.'>
									  <option value="'.$mrr.'">';
										  if($mrr == 1)
											{
											  echo "Sim</option>";
											  echo "<option value='0'>Não</option>";
											}
											else
											{
											  echo "Não</option>";
											  echo "<option value='1'>Sim</option>";
											}
					echo '		  </select>';
                    echo '         </div>
							  <div class="col-lg-2">
                                  <p class="form-control-static"><b>Cronograma?</b></p>
								  <select class="form-control" name="schedule" '.$interact.'>
									  <option value="'.$cronograma.'">';
										  if($cronograma == 1)
											{
											  echo "Sim</option>";
											  echo "<option value='0'>Não</option>";
											}
											else
											{
											  echo "Não</option>";
											  echo "<option value='1'>Sim</option>";
											}
					echo '		  </select>';
                    echo '    </div>
							  <div class="col-lg-2">
                                  <p class="form-control-static"><b>Aprovação?</b></p>
								  <select class="form-control" name="approvement" '.$interact.'>
									  <option value="'.$aprovacao.'">';
										  if($aprovacao == 1)
											{
											  echo "Sim</option>";
											  echo "<option value='0'>Não</option>";
											}
											else
											{
											  echo "Não</option>";
											  echo "<option value='1'>Sim</option>";
											}
					echo '		  </select>';
                    echo '     </div>
						  </div>';
					// ------------------------------ Previsto e realizado pra fase ---------------------------//
					if($interact != "disabled")
					{
						echo '<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label"><h4>'.$fase.' Previsto: '.$previsto.'</h4></label>
						  </div>
						  <div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label"><h4>'.$fase.' Realizado: '.$realizado.'</h4></label>
						  </div>';
						echo '<div class="form-group">
								<div class="col-sm-2">
									  <button class="btn btn-success btn-sm pull-left" name="update_project" type="submit">Salvar Alterações</button>
								</div>';
						echo '	<div class="col-sm-2">
                                <a class="btn btn-success btn-sm pull-left" href="history.php?p='.$id.'">Ver histórico do projeto</a>
                            </div>
						  </div>';
					}
					else
					{
						echo '	<div class="form-group">
									<label class="col-lg-12 col-sm-12 control-label"><h4>Projeto '.$fase.'</h4></label>
								</div>';
						echo '	<div class="form-group">
									<div class="col-sm-2">
										<a class="btn btn-success btn-sm pull-left" href="history.php?p='.$id.'">Ver histórico do projeto</a>
									</div>
								</div>';
					}
				}
			}				
		}
	}
	
	public function showmyprojects()
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
			ltm.nome_lc AS NomeLiderTestes, 
			lp.nome_lp AS NomeLiderProjetos, 
			user.nome_user AS NomeAnalista, 
			fases.nome_f AS NomeFase,
			status.nome_status AS NomeStatus,
			mot_pend.nome_mtp AS NomeMotivo 
			FROM tab_projeto AS projeto 
			INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
			INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
			INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
			INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
			INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
			INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
			WHERE projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$idprojeto = $result->ID;
					$id_phase = $result->ID_fase;
					$ts = $result->TS;
					$nomeprojeto = $result->NomeProjeto;
					$ltm = $result->NomeLiderTestes;
					$lp = $result->NomeLiderProjetos;
					$analista = $result->NomeAnalista;
					$fase = $result->NomeFase;
					$status = $result->NomeStatus;
					$pendencia = $result->NomeMotivo;
					echo '		<tr>';
					echo '			  <td class="numeric">'.$ts.'</td>';
					echo '			  <td>'.$nomeprojeto.'</td>';
					echo '			  <td>'.$ltm.'</td>';
					echo '			  <td>'.$lp.'</td>';
					echo '			  <td>'.$analista.'</td>';
					echo '			  <td>'.$fase.'</td>';
					echo '			  <td>'.$status.'</td>';
					echo '			  <td>'.$pendencia.'</td>';
					echo '			  <td>';
					if(($id_phase != 5) && ($id_phase != 8))
					{
						echo '				<a data-toggle="modal" href="myprojects.php#myModal'.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
						echo '				<a data-toggle="modal" href="myprojects.php#encerramento'.$idprojeto.'"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></a>';
						echo '				<a data-toggle="modal" href="myprojects.php#cancelamento'.$idprojeto.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>';
					}
						echo '				<a href="project.php?p='.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>';
										echo '			  </td>';
					echo '		</tr>';
				}
			}
		}
	}
	
	public function showtmprojects($id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, 
			ltm.nome_lc AS NomeLiderTestes, 
			lp.nome_lp AS NomeLiderProjetos, 
			user.nome_user AS NomeAnalista, 
			fases.nome_f AS NomeFase,
			status.nome_status AS NomeStatus,
			mot_pend.nome_mtp AS NomeMotivo 
			FROM tab_projeto AS projeto 
			INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
			INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
			INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
			INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
			INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
			INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
			WHERE projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->bindParam(':user', $id, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$idprojeto = $result->ID;
					$ts = $result->TS;
					$nomeprojeto = $result->NomeProjeto;
					$ltm = $result->NomeLiderTestes;
					$lp = $result->NomeLiderProjetos;
					$analista = $result->NomeAnalista;
					$fase = $result->NomeFase;
					$status = $result->NomeStatus;
					$pendencia = $result->NomeMotivo;
					echo '		<tr>';
					echo '			  <td class="numeric">'.$ts.'</td>';
					echo '			  <td>'.$nomeprojeto.'</td>';
					echo '			  <td>'.$ltm.'</td>';
					echo '			  <td>'.$lp.'</td>';
					echo '			  <td>'.$analista.'</td>';
					echo '			  <td>'.$fase.'</td>';
					echo '			  <td>'.$status.'</td>';
					echo '			  <td>'.$pendencia.'</td>';
					echo '			  <td>';
					echo '				<a href="project.php?p='.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>';
					echo '			  </td>';
					echo '		</tr>';
				}
			}
		}
	}
	/* ------------------------------------------------- HISTORY FUNCTIONS ------------------------------------------*/
	public function addHistoryNote($date, $phase, $predicted, $acomplished, $note, $prj, $user){
		$connect = new connection;
		
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "INSERT INTO tab_historico(data_hst, id_f, prvt_hst, rlzd_hst, desc_hst, id_prj, id_user) 
			VALUES(:date, :phase, :predicted, :acomplished, :note, :prj, :user)";
			$query = $connector->prepare($sql);
			$query->bindParam(':date', $date, PDO::PARAM_STR);
			$query->bindParam(':phase', $phase, PDO::PARAM_INT);
			$query->bindParam(':predicted', $predicted, PDO::PARAM_INT);
			$query->bindParam(':acomplished', $acomplished, PDO::PARAM_INT);
			$query->bindParam(':note', $note, PDO::PARAM_STR);
			$query->bindParam(':prj', $prj, PDO::PARAM_INT);
			$query->bindParam(':user', $user, PDO::PARAM_INT);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC>0)
			{
				$updatephase = "UPDATE tab_projeto SET id_f=:phase WHERE id_prj=:prj";
				$queryup = $connector->prepare($updatephase);
				$queryup->bindParam(':phase', $phase, PDO::PARAM_INT);
				$queryup->bindParam(':prj', $prj, PDO::PARAM_INT);
				$queryup->execute();
				echo '<script>alert("Nota adicionada com sucesso!"); window.location.href = "history.php?p='.$prj.'"</script>';
			}
		}
	}
	
	public function UpdatePhase($phase, $note, $prj, $user, $type){
		$connect = new connection;
		
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "INSERT INTO tab_historico(data_hst, id_f, desc_hst, id_prj, id_user) 
			VALUES(NOW(), :phase, :note, :prj, :user)";
			$query = $connector->prepare($sql);
			$query->bindParam(':phase', $phase, PDO::PARAM_INT);
			$query->bindParam(':note', $note, PDO::PARAM_STR);
			$query->bindParam(':prj', $prj, PDO::PARAM_INT);
			$query->bindParam(':user', $user, PDO::PARAM_INT);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC>0)
			{
				$updatephase = "UPDATE tab_projeto SET id_f=:phase WHERE id_prj=:prj";
				$queryup = $connector->prepare($updatephase);
				$queryup->bindParam(':phase', $phase, PDO::PARAM_INT);
				$queryup->bindParam(':prj', $prj, PDO::PARAM_INT);
				$queryup->execute();
				if($type == 0)
				{
					echo '<script>alert("O projeto foi encerrado e/ou cancelado com sucesso!"); window.location.href = "projects.php"</script>';
				}
				else
				{
					echo '<script>alert("O projeto foi encerrado e/ou cancelado com sucesso!"); window.location.href = "myprojects.php"</script>';
				}
			}
		}
	}
	
	public function getHistory($prj)
	{
		$connect = new connection;
		
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			$sql = "SELECT historico.data_hst AS data, historico.prvt_hst AS previsto, historico.rlzd_hst AS realizado, historico.desc_hst AS descricao, 
			user.id_user AS id_user, user.nome_user AS nomeuser, 
			fases.id_f AS id_fase, fases.nome_f AS nomefase 
			FROM tab_historico AS historico 
			INNER JOIN tab_fases AS fases ON historico.id_f = fases.id_f 
			INNER JOIN tab_user AS user ON historico.id_user = user.id_user 
			WHERE historico.id_prj=:id ORDER BY historico.data_hst DESC";
			$query = $connector->prepare($sql);
			$query->bindParam(':id', $prj, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					if($result->previsto>0)
					{
						$previsto = $result->previsto;
					}
					else
					{
						$previsto = "-";
					}
					
					if($result->realizado>0)
					{
						$realizado = $result->realizado;
					}
					else
					{
						$realizado = "-";
					}
					echo '	<tr>
								<td>'.$result->nomefase.'</td>
								<td>'.date('d/m/Y', strtotime($result->data)).'</td>
								<td>'.$previsto.'</td>
								<td>'.$realizado.'</td>
								<td>'.$result->nomeuser.'</td>
								<td>'.$result->descricao.'</td>
							</tr>';
				}
			}
		}
	}
	
	public function FilterHistory($prj, $from, $to)
	{
		$connect = new connection;
		
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			$sql = "SELECT historico.data_hst AS data, historico.prvt_hst AS previsto, historico.rlzd_hst AS realizado, historico.desc_hst AS descricao, 
			user.id_user AS id_user, user.nome_user AS nomeuser, 
			fases.id_f AS id_fase, fases.nome_f AS nomefase 
			FROM tab_historico AS historico 
			INNER JOIN tab_fases AS fases ON historico.id_f = fases.id_f 
			INNER JOIN tab_user AS user ON historico.id_user = user.id_user 
			WHERE historico.id_prj=:id AND historico.data_hst BETWEEN :from AND :to ORDER BY historico.data_hst DESC";
			$query = $connector->prepare($sql);
			$query->bindParam(':id', $prj, PDO::PARAM_STR);
			$query->bindParam(':from', $from, PDO::PARAM_STR);
			$query->bindParam(':to', $to, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					if($result->previsto>0)
					{
						$previsto = $result->previsto;
					}
					else
					{
						$previsto = "-";
					}
					
					if($result->realizado>0)
					{
						$realizado = $result->realizado;
					}
					else
					{
						$realizado = "-";
					}
					echo '	<tr>
								<td>'.$result->nomefase.'</td>
								<td>'.date('d/m/Y', strtotime($result->data)).'</td>
								<td>'.$previsto.'</td>
								<td>'.$realizado.'</td>
								<td>'.$result->nomeuser.'</td>
								<td>'.$result->descricao.'</td>
							</tr>';
				}
			}
		}
	}
	
	// SHOW MODALS
	public function manageAddHistoryModal()
	{
		$param = new parameters;
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
			ltm.nome_lc AS NomeLiderTestes, 
			lp.nome_lp AS NomeLiderProjetos, 
			user.nome_user AS NomeAnalista, 
			fases.nome_f AS NomeFase,
			status.nome_status AS NomeStatus,
			mot_pend.nome_mtp AS NomeMotivo 
			FROM tab_projeto AS projeto 
			INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
			INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
			INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
			INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
			INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
			INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
			WHERE projeto.id_cc=:cc";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$idprojeto = $result->ID;
					$id_fase = $result->ID_fase;
					$ts = $result->TS;
					$nomeprojeto = $result->NomeProjeto;
					$ltm = $result->NomeLiderTestes;
					$lp = $result->NomeLiderProjetos;
					$analista = $result->NomeAnalista;
					$fase = $result->NomeFase;
					$status = $result->NomeStatus;
					$pendencia = $result->NomeMotivo;
					
					echo '
							<!-- Modal Add nota-->
							  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal'.$idprojeto.'" class="modal fade">
								<form method="post" action="">
								  <div class="modal-dialog">
									  <div class="modal-content">
										  <div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											  <h4 class="modal-title">Adicionar Nota</h4>
										  </div>
										  <input id="id" name="id" type="hidden" value="'.$idprojeto.'">
										  <div class="modal-body">
											<p>Data</p>
											<input class="form-control" required name="date" type="date" max="'.date("Y-m-d", time()).'" value="'.date("Y-m-d", time()).'" data-mask="00-00-0000"/>
											<p><br/>Fase</p>
											<select class="form-control" name="phase" required>';
											  $param->getOnePhase($id_fase);
											  $param->getPhases("select", $id_fase);
					echo '					</select>
											<p>Previsto</p>
											<input class="form-control" type="text" name="predicted" required/>
											<p>Realizado</p>
											<input class="form-control" name="accomplished" required type="text"/>
											<p><br/>Nota</p>
											<textarea class="form-control" rows="5" id="comment" name="note" required></textarea>
										  </div>
										  <div class="modal-footer">
											  <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
											  <button class="btn btn-theme" type="submit" name="add_note">Adicionar</button>
										  </div>
									  </div>
								  </div>
								</form>
							  </div>
							<!-- modal -->	
						';
						
					echo '
						<!-- Modal encerramento-->
						  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="encerramento'.$idprojeto.'" class="modal fade">
							<form method="post" action="">
							  <div class="modal-dialog">
								  <div class="modal-content">
									  <div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h4 class="modal-title">Tem certeza que deseja finalizar o projeto?</h4>
									  </div>
									  <input id="id" name="id" type="hidden" value="'.$idprojeto.'">
									  <div class="modal-footer">
										  <button data-dismiss="modal" class="btn btn-default" type="button">Não</button>
										  <button class="btn btn-theme" type="submit" name="finish_project">Sim</button>
									  </div>
								  </div>
							  </div>
							</form>
						  </div>
						<!-- modal -->
					';
					
					echo '
						<!-- Modal cancelamento-->
						  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="cancelamento'.$idprojeto.'" class="modal fade">
							<form method="post" action="">
							  <div class="modal-dialog">
								  <div class="modal-content">
									  <div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h4 class="modal-title">Cancelamento de projetos</h4>
									  </div>
									  <div class="modal-body">
										<p><br/>Motivo</p>
										<select class="form-control" name="reason" required>
											<option value="Alto Custo">Alto Custo</option>
											<option value="Cobertura">Cobertura</option>
											<option value="Prazo">Prazo</option>
											<option value="Outros">Outros</option>
										</select>
										<textarea class="form-control" rows="5" id="comment" name="note"></textarea>
										<input id="id" name="id" type="hidden" value="'.$idprojeto.'">
									  </div>
									  <div class="modal-footer">
										  <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
										  <button class="btn btn-theme" type="submit" name="cancel_project">Confirmar Cancelamento</button>
									  </div>
								  </div>
							  </div>
							</form>
						  </div>
						<!-- modal -->
					';
				}
			}
		}
	}
	
	public function MyprojectsAddNote()
	{
		$connect = new connection;
		$param = new parameters;
		
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
			ltm.nome_lc AS NomeLiderTestes, 
			lp.nome_lp AS NomeLiderProjetos, 
			user.nome_user AS NomeAnalista, 
			fases.nome_f AS NomeFase,
			status.nome_status AS NomeStatus,
			mot_pend.nome_mtp AS NomeMotivo 
			FROM tab_projeto AS projeto 
			INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
			INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
			INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
			INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
			INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
			INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
			WHERE projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user AND projeto.id_f != 5 AND projeto.id_f != 8";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$idprojeto = $result->ID;
					$id_fase = $result->ID_fase;
					$ts = $result->TS;
					$nomeprojeto = $result->NomeProjeto;
					$ltm = $result->NomeLiderTestes;
					$lp = $result->NomeLiderProjetos;
					$analista = $result->NomeAnalista;
					$fase = $result->NomeFase;
					$status = $result->NomeStatus;
					$pendencia = $result->NomeMotivo;
					
					echo '
							<!-- Modal Add nota-->
							  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal'.$idprojeto.'" class="modal fade">
								<form method="post" action="">
								  <div class="modal-dialog">
									  <div class="modal-content">
										  <div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											  <h4 class="modal-title">Adicionar Nota</h4>
										  </div>
										  <input id="id" name="id" type="hidden" value="'.$idprojeto.'">
										  <div class="modal-body">
											<p>Data</p>
											<input class="form-control" required name="date" type="date" max="'.date("Y-m-d", time()).'" value="'.date("Y-m-d", time()).'" data-mask="00-00-0000"/>
											<p><br/>Fase</p>
											<select class="form-control" name="phase" required>';
											  $param->getOnePhase($id_fase);
											  $param->getPhases("select", $id_fase);
					echo '					</select>
											<p>Previsto</p>
											<input class="form-control" type="text" name="predicted" required/>
											<p>Realizado</p>
											<input class="form-control" name="accomplished" required type="text"/>
											<p><br/>Nota</p>
											<textarea class="form-control" rows="5" id="comment" name="note" required></textarea>
										  </div>
										  <div class="modal-footer">
											  <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
											  <button class="btn btn-theme" type="submit" name="add_note">Adicionar</button>
										  </div>
									  </div>
								  </div>
								</form>
							  </div>
							<!-- modal -->	
						';
						
					echo '
						<!-- Modal encerramento-->
						  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="encerramento'.$idprojeto.'" class="modal fade">
							<form method="post" action="">
							  <div class="modal-dialog">
								  <div class="modal-content">
									  <div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h4 class="modal-title">Tem certeza que deseja finalizar o projeto?</h4>
									  </div>
									  <input id="id" name="id" type="hidden" value="'.$idprojeto.'">
									  <div class="modal-footer">
										  <button data-dismiss="modal" class="btn btn-default" type="button">Não</button>
										  <button class="btn btn-theme" type="submit" name="finish_project">Sim</button>
									  </div>
								  </div>
							  </div>
							</form>
						  </div>
						<!-- modal -->
					';
					
					echo '
						<!-- Modal cancelamento-->
						  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="cancelamento'.$idprojeto.'" class="modal fade">
							<form method="post" action="">
							  <div class="modal-dialog">
								  <div class="modal-content">
									  <div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h4 class="modal-title">Cancelamento de projetos</h4>
									  </div>
									  <div class="modal-body">
										<p><br/>Motivo</p>
										<select class="form-control" name="reason" required>
											<option value="Alto Custo">Alto Custo</option>
											<option value="Cobertura">Cobertura</option>
											<option value="Prazo">Prazo</option>
											<option value="Outros">Outros</option>
										</select>
										<textarea class="form-control" rows="5" id="comment" name="note"></textarea>
										<input id="id" name="id" type="hidden" value="'.$idprojeto.'">
									  </div>
									  <div class="modal-footer">
										  <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
										  <button class="btn btn-theme" type="submit" name="cancel_project">Confirmar Cancelamento</button>
									  </div>
								  </div>
							  </div>
							</form>
						  </div>
						<!-- modal -->
					';
				}
			}
		}
	}
	
	// ADD NOTE HISTORY PAGE MODAL
	public function AddHistoryModal($prj)
	{
		$connect = new connection;
		$param = new parameters;
		
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			$sql = "SELECT historico.data_hst AS data, historico.prvt_hst AS previsto, historico.rlzd_hst AS realizado, historico.desc_hst AS descricao, 
			user.id_user AS id_user, user.nome_user AS nomeuser, 
			fases.id_f AS id_fase, fases.nome_f AS nomefase 
			FROM tab_historico AS historico 
			INNER JOIN tab_fases AS fases ON historico.id_f = fases.id_f 
			INNER JOIN tab_user AS user ON historico.id_user = user.id_user 
			WHERE historico.id_prj=:id ORDER BY historico.data_hst DESC";
			$query = $connector->prepare($sql);
			$query->bindParam(':id', $prj, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					echo '
							<!-- Modal Add nota-->
							  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal'.$prj.'" class="modal fade">
								<form method="post" action="">
								  <div class="modal-dialog">
									  <div class="modal-content">
										  <div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											  <h4 class="modal-title">Adicionar Nota</h4>
										  </div>
										  <input id="id" name="id" type="hidden" value="'.$prj.'">
										  <div class="modal-body">
											<p>Data</p>
											<input class="form-control" required name="date" type="date" max="'.date("Y-m-d", time()).'" value="'.date("Y-m-d", time()).'" data-mask="00-00-0000"/>
											<p><br/>Fase</p>
											<select class="form-control" name="phase" required>';
											  $param->getOnePhase($result->id_fase);
											  $param->getPhases("select", $result->id_fase);
					echo '					</select>
											<p>Previsto</p>
											<input class="form-control" type="text" name="predicted" value="'.$result->previsto.'" required/>
											<p>Realizado</p>
											<input class="form-control" name="accomplished" required type="text"/>
											<p><br/>Nota</p>
											<textarea class="form-control" rows="5" id="comment" name="note" required></textarea>
										  </div>
										  <div class="modal-footer">
											  <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
											  <button class="btn btn-theme" type="submit" name="add_note">Adicionar</button>
										  </div>
									  </div>
								  </div>
								</form>
							  </div>
							<!-- modal -->	
						';
				}
			}
		}
	}
	/* ----------------------------------------- END  HISTORY FUNCTIONS ------------------------------------------*/
	// ---------------------------------------------- MANAGER VIEW ----------------------------------------------//
	public function manage()
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, projeto.id_f AS ID_fase, 
			ltm.nome_lc AS NomeLiderTestes, 
			lp.nome_lp AS NomeLiderProjetos, 
			user.nome_user AS NomeAnalista, 
			fases.nome_f AS NomeFase,
			status.nome_status AS NomeStatus,
			mot_pend.nome_mtp AS NomeMotivo 
			FROM tab_projeto AS projeto 
			INNER JOIN tab_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
			INNER JOIN tab_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
			INNER JOIN tab_user AS user ON user.id_user = projeto.id_inmetrics_user 
			INNER JOIN tab_fases AS fases ON fases.id_f = projeto.id_f 
			INNER JOIN tab_status AS status ON status.id_status = projeto.id_status 
			INNER JOIN tab_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
			WHERE projeto.id_cc=:cc";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$idprojeto = $result->ID;
					$id_phase = $result->ID_fase;
					$ts = $result->TS;
					$nomeprojeto = $result->NomeProjeto;
					$ltm = $result->NomeLiderTestes;
					$lp = $result->NomeLiderProjetos;
					$analista = $result->NomeAnalista;
					$fase = $result->NomeFase;
					$status = $result->NomeStatus;
					$pendencia = $result->NomeMotivo;
					echo '		<tr>';
					echo '			  <td class="numeric">'.$ts.'</td>';
					echo '			  <td>'.$nomeprojeto.'</td>';
					echo '			  <td>'.$ltm.'</td>';
					echo '			  <td>'.$lp.'</td>';
					echo '			  <td>'.$analista.'</td>';
					echo '			  <td>'.$fase.'</td>';
					echo '			  <td>'.$status.'</td>';
					echo '			  <td>'.$pendencia.'</td>';
					echo '			  <td>';
					if(($id_phase != 5) && ($id_phase != 8))
					{
						echo '				<a data-toggle="modal" href="projects.php#myModal'.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
						echo '				<a data-toggle="modal" href="projects.php#encerramento'.$idprojeto.'"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></a>';
						echo '				<a data-toggle="modal" href="projects.php#cancelamento'.$idprojeto.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>';
					}
					echo '				<a href="project.php?p='.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>';
					echo '			  </td>';
					echo '		</tr>';
				}
			}
		}
	}
	
	
	
	// GET ANY PROJECT FIELD
	public function getProjectField($id, $field)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT $field FROM tab_projeto WHERE id_prj=:u";
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
}
?>