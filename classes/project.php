<?php
require_once('connection.php');
require_once('parameters.php');
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
			FROM TAB_projeto AS projeto 
			INNER JOIN TAB_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
			INNER JOIN TAB_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
			INNER JOIN TAB_user AS user ON user.id_user = projeto.id_inmetrics_user 
			INNER JOIN TAB_fases AS fases ON fases.id_f = projeto.id_f 
			INNER JOIN TAB_status AS status ON status.id_status = projeto.id_status 
			INNER JOIN TAB_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
			INNER JOIN TAB_historico AS historico ON historico.id_prj = projeto.id_prj 
			WHERE projeto.id_cc=:cc AND projeto.id_prj=:proj AND historico.id_hst = (SELECT MAX(historico.id_hst) from TAB_historico AS historico)"; 
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->bindParam(':proj', $id, PDO::PARAM_STR);
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
					
					echo '<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Ticket Service</label>
							<div class="col-sm-2">
								<input class="form-control" id="disabledInput" type="text" value="'.$ts.'" disabled>
							</div>
						</div>';
						
					echo '<div class="form-group">
                              <label class="col-lg-2 col-sm-2 control-label">Projeto</label>
							  <div class="col-sm-6">
                                  <input type="text"  class="form-control" value="'.$nome.'" disabled>
                              </div>
                          </div>';
						  
					echo '<div class="form-group">
                              <label class="col-lg-12 col-sm-12 control-label"><h4>Líderes</h4></label>
                              <div class="col-lg-3">
                                  <p class="form-control-static"><b>Testes e Mudanças:</b></p>
								  <select class="form-control">
									  <option value="'.$id_ltm.'">'.$ltm.'</option>';
									  // OTHERS LTM
										$lc = new parameters;
										$lc->getLTM("select", $id_ltm);
					echo '		  </select>
                              </div>
							  <div class="col-lg-3">
                                  <p class="form-control-static"><b>Projeto Rede:</b></p>
								  <select class="form-control">
									  <option value="'.$id_lp.'">'.$lp.'</option>';
									// OTHERS LP
									$lp = new parameters;
									$lp->getLP("select", $id_lp);
					echo '		  </select>
                              </div>
							   <div class="col-lg-4">
                                  <p class="form-control-static"><b>Responsável Inmetrics:</b></p>
								  <select class="form-control">
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
								  <select class="form-control">
									  <option value="'.$id_f.'">'.$fase.'</option>';
									  // OTHERS ANALYST
									  $phase = new parameters;
									  $phase->getPhases("select", $id_f);
					echo 		  '</select>
                              </div>
							  <div class="col-lg-3">
                                  <p class="form-control-static"><b>Status:</b></p>
								  <select class="form-control">
									  <option value="'.$id_status.'">'.$status.'</option>';
									  // OTHERS STATUS
									  $phase = new parameters;
									  $phase->getStatus("select", $id_status);
					echo '		  </select>
                              </div>
							   <div class="col-lg-4">
                                  <p class="form-control-static"><b>Motivo da pendência</b></p>
								  <select class="form-control">
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
								    <select class="form-control">
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
								  <select class="form-control">
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
								  <select class="form-control">
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
								  <select class="form-control">
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
								  <select class="form-control">
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
					echo '<div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label"><h4>'.$fase.' Previsto: '.$previsto.'</h4></label>
						  </div>
						  <div class="form-group">
							<label class="col-lg-12 col-sm-12 control-label"><h4>'.$fase.' Realizado: '.$realizado.'</h4></label>
						  </div>';
					echo '<div class="form-group">
							<div class="col-sm-2">
                                  <a class="btn btn-success btn-sm pull-left" href="history.php?p='.$id.'">Salvar Alterações</a>
                              </div>
							<div class="col-sm-2">
                                <a class="btn btn-success btn-sm pull-left" href="history.php?p='.$id.'">Ver histórico do projeto</a>
                            </div>
						  </div>';
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
			$sql = "SELECT projeto.id_prj AS ID, projeto.ts_prj AS TS, projeto.nmp_prj AS NomeProjeto, 
			ltm.nome_lc AS NomeLiderTestes, 
			lp.nome_lp AS NomeLiderProjetos, 
			user.nome_user AS NomeAnalista, 
			fases.nome_f AS NomeFase,
			status.nome_status AS NomeStatus,
			mot_pend.nome_mtp AS NomeMotivo 
			FROM TAB_projeto AS projeto 
			INNER JOIN TAB_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
			INNER JOIN TAB_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
			INNER JOIN TAB_user AS user ON user.id_user = projeto.id_inmetrics_user 
			INNER JOIN TAB_fases AS fases ON fases.id_f = projeto.id_f 
			INNER JOIN TAB_status AS status ON status.id_status = projeto.id_status 
			INNER JOIN TAB_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
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
					echo '				<a data-toggle="modal" href="myprojects.php#myModal"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
					echo '				<a href="project.php?p='.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>';
					echo '				<a data-toggle="modal" href="myprojects.php#encerramento"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></a>';
					echo '				<a data-toggle="modal" href="myprojects.php#cancelamento"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>';
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
			FROM TAB_projeto AS projeto 
			INNER JOIN TAB_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
			INNER JOIN TAB_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
			INNER JOIN TAB_user AS user ON user.id_user = projeto.id_inmetrics_user 
			INNER JOIN TAB_fases AS fases ON fases.id_f = projeto.id_f 
			INNER JOIN TAB_status AS status ON status.id_status = projeto.id_status 
			INNER JOIN TAB_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
			WHERE projeto.id_cc=:cc AND projeto.id_inmetrics_user=:user AND projeto.id_f != 5 AND projeto.id_f != 8";
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
	
	public function getHistory($prj)
	{
		$connect = new connection;
		
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			$sql = "SELECT historico.data_hst AS data, historico.prvt_hst AS previsto, historico.rlzd_hst AS realizado, historico.desc_hst AS descricao, 
			user.id_user AS id_user, user.nome_user AS nomeuser, 
			fases.id_f AS id_fase, fases.nome_f AS nomefase 
			FROM TAB_historico AS historico 
			INNER JOIN TAB_fases AS fases ON historico.id_f = fases.id_f 
			INNER JOIN TAB_user AS user ON historico.id_user = user.id_user 
			WHERE historico.id_prj=:id ORDER BY historico.data_hst DESC";
			$query = $connector->prepare($sql);
			$query->bindParam(':id', $prj, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					echo '	<tr>
								<td>'.$result->nomefase.'</td>
								<td>'.date('d/m/Y', strtotime($result->data)).'</td>
								<td>'.$result->previsto.'</td>
								<td>'.$result->realizado.'</td>
								<td>'.$result->nomeuser.'</td>
								<td>'.$result->descricao.'</td>
							</tr>';
				}
			}
		}
	}
	// ---------------------------------------------- MANAGER VIEW ----------------------------------------------//
	public function manage()
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
			FROM TAB_projeto AS projeto 
			INNER JOIN TAB_lider_cliente AS ltm ON ltm.id_lc = projeto.id_lc 
			INNER JOIN TAB_lider_projeto AS lp ON lp.id_lp = projeto.id_lp 
			INNER JOIN TAB_user AS user ON user.id_user = projeto.id_inmetrics_user 
			INNER JOIN TAB_fases AS fases ON fases.id_f = projeto.id_f 
			INNER JOIN TAB_status AS status ON status.id_status = projeto.id_status 
			INNER JOIN TAB_mot_pend AS mot_pend ON mot_pend.id_mtp = projeto.id_mtp 
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
					echo '				<a data-toggle="modal" href="projects.php#myModal"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>';
					echo '				<a href="project.php?p='.$idprojeto.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>';
					echo '				<a data-toggle="modal" href="projects.php#encerramento"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></a>';
					echo '				<a data-toggle="modal" href="projects.php#cancelamento"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>';
					echo '			  </td>';
					echo '		</tr>';
				}
			}
		}
	}
	
	
}
?>