<?php
require_once('connection.php');

class parameters
{
	private static $client;
	/* ----------------------------------- INSERT METHODS --------------------------------------*/
	//DELETE CLIENT LEADER
	public function DeleteLTM($type, $id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			if($type == 1)
			{
				$connector = $connect->getConnector();
				$sql = "UPDATE TAB_lider_cliente SET active_lc=1 WHERE id_lc=:id";
				$query = $connector->prepare($sql);
				$query->bindParam(':id', $id, PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC == 1)
				{
					echo '<script>alert("O líder foi desativado com sucesso!"); window.location.href = "ltm.php"</script>';
				}
				else
				{
					echo '<script>alert("Erro ao tentar efetuar exclusão!"); window.location.href = "ltm.php"</script>';
				}
			}
			else
			{
				$connector = $connect->getConnector();
				$sql = "UPDATE TAB_lider_projeto SET active_lp=1 WHERE id_lp=:id";
				$query = $connector->prepare($sql);
				$query->bindParam(':id', $id, PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC == 1)
				{
					echo '<script>alert("O líder foi desativado com sucesso!"); window.location.href = "lp.php"</script>';
				}
				else
				{
					echo '<script>alert("Erro ao tentar efetuar exclusão!"); window.location.href = "lp.php"</script>';
				}
			}
		}
		else
		{
			echo '<script>alert("Erro ao conectar com o banco de dados!"); window.location.href = "lp.php"</script>';
		}
	}
	
	//UPDATE CLIENT LEADER
	public function UpdateLTM($type, $id, $name, $email, $responsable){
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			
			if($type == 1)
			{
				$sql = "UPDATE TAB_lider_cliente SET nome_lc=?, email_lc=?, id_user=? WHERE id_lc=?";
				$query=$connector->prepare($sql);
				$query->bindParam(1, $name, PDO::PARAM_STR);
				$query->bindParam(2, $email, PDO::PARAM_STR);
				$query->bindParam(3, $responsable, PDO::PARAM_STR);
				$query->bindParam(4, $id, PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC == 1)
				{
					echo '<script>alert("Os dados foram alterados com sucesso!"); window.location.href = "ltm.php"</script>';
				}
				else
				{
					echo '<script>alert("Erro ao efetuar alteração!"); window.location.href = "ltm.php"</script>';
				}
			}
			else
			{
				$sql = "UPDATE TAB_lider_projeto SET nome_lp=?, email_lp=?, id_user=? WHERE id_lp=?";
				$query=$connector->prepare($sql);
				$query->bindParam(1, $name, PDO::PARAM_STR);
				$query->bindParam(2, $email, PDO::PARAM_STR);
				$query->bindParam(3, $responsable, PDO::PARAM_STR);
				$query->bindParam(4, $id, PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC == 1)
				{
					echo '<script>alert("Os dados foram alterados com sucesso!"); window.location.href = "lp.php"</script>';
				}
				else
				{
					echo '<script>alert("Erro ao efetuar alteração!"); window.location.href = "lp.php"</script>';
				}
			}
			
		}
		else
		{
			echo '<script>alert("Erro ao conectar com o banco de dados!"); window.location.href = "lp.php"</script>';
		}
	}
	
	// INSERT CLIENT LEADER
	public function InsertLTM($type, $name, $email, $responsable)
	{
		
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			if($type == 1)
			{
				$getclient="SELECT id_clt FROM TAB_cc WHERE id_cc=:cc";
				$query_get_client = $connector->prepare($getclient);
				$query_get_client->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$query_get_client->execute();
				$rowC_query_get_client = $query_get_client->rowCount();
				if($rowC_query_get_client == 1)
				{
					while($result = $query_get_client->FETCH(PDO::FETCH_OBJ))
					{
						self::$client = $result->id_clt;
						$client = self::$client;
						$sql = "INSERT INTO TAB_lider_cliente(id_clt, nome_lc, email_lc, id_user) VALUES (?, ?, ?, ?)";
						$query = $connector->prepare($sql);
						$query->bindParam(1, self::$client, PDO::PARAM_STR);
						$query->bindParam(2, $name, PDO::PARAM_STR);
						$query->bindParam(3, $email, PDO::PARAM_STR);
						$query->bindParam(4, $responsable, PDO::PARAM_STR);
						$query->execute();
						$rowC = $query->rowCount();
						if($rowC>0)
						{
							echo '<script>alert("Parâmetro adicionado com sucesso!"); window.location.href = "ltm.php";</script>';
						}
						else
						{
							echo '<script>alert("Erro durante a inclusão!"); window.location.href = "ltm.php";</script>';
						}
					}
				}
				else
				{
					echo '<script>alert("Error! Client not localized!"); window.location.href = "ltm.php";</script>';
				}
			}
			else
			{
				$getclient="SELECT id_clt FROM TAB_cc WHERE id_cc=:cc";
				$query_get_client = $connector->prepare($getclient);
				$query_get_client->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$query_get_client->execute();
				$rowC_query_get_client = $query_get_client->rowCount();
				if($rowC_query_get_client == 1)
				{
					while($result = $query_get_client->FETCH(PDO::FETCH_OBJ))
					{
						self::$client = $result->id_clt;
						$client = self::$client;
						$sql = "INSERT INTO TAB_lider_projeto(id_clt, nome_lp, email_lp, id_user) VALUES (?, ?, ?, ?)";
						$query = $connector->prepare($sql);
						$query->bindParam(1, self::$client, PDO::PARAM_STR);
						$query->bindParam(2, $name, PDO::PARAM_STR);
						$query->bindParam(3, $email, PDO::PARAM_STR);
						$query->bindParam(4, $responsable, PDO::PARAM_STR);
						$query->execute();
						$rowC = $query->rowCount();
						if($rowC>0)
						{
							echo '<script>alert("Parâmetro adicionado com sucesso!"); window.location.href = "lp.php";</script>';
						}
						else
						{
							echo '<script>alert("Erro durante a inclusão!"); window.location.href = "lp.php";</script>';
						}
					}
				}
				else
				{
					echo '<script>alert("Error! Client not localized!"); window.location.href = "lp.php";</script>';
				}
			}	
		}
		else
		{
			echo '<script>alert("Erro ao conectar com o banco de dados!"); window.location.href = "lp.php"</script>';
		}
	}
	
	/* ----------------------------------- GET METHODS --------------------------------------*/
	public function getLP($type, $exception)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT LP.id_lp AS ID, LP.nome_lp AS Nome, LP.email_lp AS Email, 
			CLT.nome_clt AS NomeCliente
			FROM TAB_lider_projeto AS LP 
			INNER JOIN TAB_cliente AS CLT ON LP.id_clt = CLT.id_clt 
			WHERE LP.id_clt = (SELECT id_clt FROM TAB_cc WHERE id_cc=:cc) AND LP.active_lp = 0";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id_lp = $result->ID;
					$nome = $result->Nome;
					$email = $result->Email;
					$cliente = $result->NomeCliente;
					if($type == "select")
					{
						if($exception != $id_lp)
						{
							echo '<option value="'.$id_lp.'">'.$nome.'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_lp.'</td>
                                  <td>'.$nome.'</td>
                                  <td>'.$email.'</td>
                                  <td>'.$cliente.'</td>
								  <td>
									<a data-toggle="modal" href="lp.php=#editar'.$id_lp.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
									<a data-toggle="modal" href="lp.php#cancelamento'.$id_lp.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
								  </td>
                            </tr>';
					}
				}
			}
		}
	}
	
	public function getLTM($type, $exception)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT LC.id_lc AS ID, LC.nome_lc AS Nome, LC.email_lc AS Email, 
			CLT.nome_clt AS NomeCliente
			FROM TAB_lider_cliente AS LC 
			INNER JOIN TAB_cliente AS CLT ON LC.id_clt = CLT.id_clt 
			WHERE LC.id_clt = (SELECT id_clt FROM TAB_cc WHERE id_cc=:cc) AND LC.active_lc = 0";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id_lc = $result->ID;
					$nome = $result->Nome;
					$email = $result->Email;
					$cliente = $result->NomeCliente;
					if($type == "select")
					{
						if($id_lc != $exception)
						{
							echo '<option value="'.$id_lc.'">'.$nome.'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_lc.'</td>
                                  <td>'.$nome.'</td>
                                  <td>'.$email.'</td>
                                  <td>'.$cliente.'</td>
								  <td>
									<a data-toggle="modal" href="ltm.php#editar'.$id_lc.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
									<a data-toggle="modal" href="ltm.php#cancelamento'.$id_lc.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
								  </td>
                            </tr>';
					}
				}
			}
		}
	}
	
	//Show Update Modals
	public function getLTM_Modal($type)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			if($type == 1)
			{
				$connector = $connect->getConnector();
				$sql = "SELECT LC.id_lc AS ID, LC.nome_lc AS Nome, LC.email_lc AS Email, 
				CLT.nome_clt AS NomeCliente
				FROM TAB_lider_cliente AS LC 
				INNER JOIN TAB_cliente AS CLT ON LC.id_clt = CLT.id_clt 
				WHERE LC.id_clt = (SELECT id_clt FROM TAB_cc WHERE id_cc=:cc) AND LC.active_lc = 0";
				$query = $connector->prepare($sql);
				$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC > 0)
				{
					while($result = $query->FETCH(PDO::FETCH_OBJ))
					{
						$id_lc = $result->ID;
						$nome = $result->Nome;
						$email = $result->Email;
						echo '
							<!-- Modal Editar Líder-->
							  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editar'.$id_lc.'" class="modal fade">
								<form method="get" action="">
								  <div class="modal-dialog">
									  <div class="modal-content">
										  <div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											  <h4 class="modal-title">Editar dados do Líder de Testes e Mudanças?</h4>
										  </div>
										  <div class="modal-body">
											<input id="id" name="id" type="hidden" value="'.$id_lc.'">
											<p>Nome</p>
											<input class="form-control" type="text" name="nameuser" value="'.$nome.'"/>
											<p><br/>E-mail</p>
											<input class="form-control" type="email" name="emailuser" value="'.$email.'"/>
										  </div>
										  <div class="modal-footer">
											  <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
											  <button href="ltm.php#concluido" class="btn btn-theme" type="submit">Salvar</button>
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
			else
			{
				$connector = $connect->getConnector();
				$sql = "SELECT LP.id_lp AS ID, LP.nome_lp AS Nome, LP.email_lp AS Email, 
				CLT.nome_clt AS NomeCliente
				FROM TAB_lider_projeto AS LP 
				INNER JOIN TAB_cliente AS CLT ON LP.id_clt = CLT.id_clt 
				WHERE LP.id_clt = (SELECT id_clt FROM TAB_cc WHERE id_cc=:cc)  AND LP.active_lp = 0";
				$query = $connector->prepare($sql);
				$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC > 0)
				{
					while($result = $query->FETCH(PDO::FETCH_OBJ))
					{
						$id_lp = $result->ID;
						$nome = $result->Nome;
						$email = $result->Email;
						echo '
							<!-- Modal Editar Líder-->
							  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editar'.$id_lp.'" class="modal fade">
								<form method="get" action="">
								  <div class="modal-dialog">
									  <div class="modal-content">
										  <div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											  <h4 class="modal-title">Editar dados do Líder de Testes e Mudanças?</h4>
										  </div>
										  <div class="modal-body">
											<input id="id" name="id" type="hidden" value="'.$id_lp.'">
											<p>Nome</p>
											<input class="form-control" type="text" name="nameuser" value="'.$nome.'"/>
											<p><br/>E-mail</p>
											<input class="form-control" type="email" name="emailuser" value="'.$email.'"/>
										  </div>
										  <div class="modal-footer">
											  <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
											  <button href="ltm.php#concluido" class="btn btn-theme" type="submit">Salvar</button>
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
	}
	
	//Show DELETE Modals
	public function getLTM_DeleteModal($type)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			if($type == 1)
			{
				$connector = $connect->getConnector();
				$sql = "SELECT LC.id_lc AS ID, LC.nome_lc AS Nome, LC.email_lc AS Email, 
				CLT.nome_clt AS NomeCliente
				FROM TAB_lider_cliente AS LC 
				INNER JOIN TAB_cliente AS CLT ON LC.id_clt = CLT.id_clt 
				WHERE LC.id_clt = (SELECT id_clt FROM TAB_cc WHERE id_cc=:cc) AND LC.active_lc = 0";
				$query = $connector->prepare($sql);
				$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC > 0)
				{
					while($result = $query->FETCH(PDO::FETCH_OBJ))
					{
						$id_lc = $result->ID;
						echo '
							<!-- Modal cancelamento-->
							  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="cancelamento'.$id_lc.'" class="modal fade">
								<form method="get" action="">
								  <div class="modal-dialog">
									  <div class="modal-content">
										  <div class="modal-header">
											  <input id="delete" name="delete" type="hidden" value="'.$id_lc.'">
											  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											  <h4 class="modal-title">Tem certeza que deseja excluir o Líder de Testes?</h4>
										  </div>
										  <div class="modal-footer">
											  <button data-dismiss="modal" class="btn btn-default" type="button">Não</button>
											  <button href="index.php#cancelado" class="btn btn-theme" type="submit">Sim</button>
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
			else
			{
				$connector = $connect->getConnector();
				$sql = "SELECT LP.id_lp AS ID, LP.nome_lp AS Nome, LP.email_lp AS Email, 
				CLT.nome_clt AS NomeCliente
				FROM TAB_lider_projeto AS LP 
				INNER JOIN TAB_cliente AS CLT ON LP.id_clt = CLT.id_clt 
				WHERE LP.id_clt = (SELECT id_clt FROM TAB_cc WHERE id_cc=:cc) AND LP.active_lp = 0";
				$query = $connector->prepare($sql);
				$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
				$query->execute();
				$rowC = $query->rowCount();
				if($rowC > 0)
				{
					while($result = $query->FETCH(PDO::FETCH_OBJ))
					{
						$id_lp = $result->ID;
						echo '
							<!-- Modal cancelamento-->
							  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="cancelamento'.$id_lp.'" class="modal fade">
								<form method="get" action="">
								  <div class="modal-dialog">
									  <div class="modal-content">
										  <div class="modal-header">
											  <input id="delete" name="delete" type="hidden" value="'.$id_lp.'">
											  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											  <h4 class="modal-title">Tem certeza que deseja excluir o Líder de Testes?</h4>
										  </div>
										  <div class="modal-footer">
											  <button data-dismiss="modal" class="btn btn-default" type="button">Não</button>
											  <button href="index.php#cancelado" class="btn btn-theme" type="submit">Sim</button>
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
	}
	
	
	public function getAnalyst($type, $exception)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT user.id_user AS ID, user.nome_user AS Nome, user.email_in_user AS Email, user.funcao_user AS Funcao, 
			CC.desc_cc AS CentroDeCusto
			FROM TAB_user AS user 
			INNER JOIN TAB_cc AS CC ON user.id_cc = CC.id_cc 
			WHERE user.id_CC =:cc AND user.active_user = 0";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id_user = $result->ID;
					$nome = $result->Nome;
					$email = $result->Email;
					$funcao = $result->Funcao;
					$cc = $result->CentroDeCusto;
					if($type == "select")
					{
						if($id_user != $exception)
						{
							echo '<option value="'.$id_user.'">'.$nome.'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_user.'</td>
                                  <td>'.$nome.'</td>
                                  <td>'.$email.'</td>
                                  <td>'.$cc.'</td>
								  <td>'.$funcao.'</td>
								  <td>
									<a data-toggle="modal" href="manageusers.php#editar"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
									<a data-toggle="modal" href="manageusers.php#cancelamento"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
								  </td>
                            </tr>';
					}
				}
			}
		}
	}
	
	public function getPhases($type, $exception)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT fases.id_f AS ID, fases.nome_f AS Nome, fases.desc_f AS Descricao
			FROM TAB_fases AS fases";
			$query = $connector->prepare($sql);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id_phase = $result->ID;
					$nome = $result->Nome;
					$description = $result->Descricao;
					if($type == "select")
					{
						if($id_phase != $exception)
						{
							echo '<option value="'.$id_phase.'">'.$nome.'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_phase.'</td>
                                  <td>'.$nome.'</td>
                                  <td>'.$description.'</td>
								  <td>
									<a data-toggle="modal" href="lp.php#editar"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
									<a data-toggle="modal" href="lp.php#cancelamento"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
								  </td>
                            </tr>';
					}
				}
			}
		}
	}
	
	public function getOnePhase($phaseid)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT fases.id_f AS ID, fases.nome_f AS Nome, fases.desc_f AS Descricao
			FROM TAB_fases AS fases WHERE fases.id_f=:phase";
			$query = $connector->prepare($sql);
			$query->bindParam(':phase', $phaseid, PDO::PARAM_INT);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id_phase = $result->ID;
					$nome = $result->Nome;
					$description = $result->Descricao;
					echo '<option value="'.$id_phase.'">'.$nome.'</option>';
				}
			}
		}
	}
	
	public function getStatus($type, $exception)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT status.id_status AS ID, status.nome_status AS Nome, status.desc_status AS Descricao
			FROM TAB_status AS status";
			$query = $connector->prepare($sql);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id_status = $result->ID;
					$nome = $result->Nome;
					$description = $result->Descricao;
					if($type == "select")
					{
						if($id_status != $exception)
						{
							echo '<option value="'.$id_status.'">'.$nome.'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_status.'</td>
                                  <td>'.$nome.'</td>
                                  <td>'.$description.'</td>
								  <td>
									<a data-toggle="modal" href="lp.php#editar"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
									<a data-toggle="modal" href="lp.php#cancelamento"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
								  </td>
                            </tr>';
					}
				}
			}
		}
	}
	
	public function getPendencia($type, $exception)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT Pendencia.id_mtp AS ID, Pendencia.nome_mtp AS Nome, Pendencia.desc_mtp AS Descricao
			FROM TAB_mot_pend AS Pendencia";
			$query = $connector->prepare($sql);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id_mtp = $result->ID;
					$nome = $result->Nome;
					$description = $result->Descricao;
					if($type == "select")
					{
						if($id_mtp != $exception)
						{
							echo '<option value="'.$id_mtp.'">'.$nome.'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_mtp.'</td>
                                  <td>'.$nome.'</td>
                                  <td>'.$description.'</td>
								  <td>
									<a data-toggle="modal" href="lp.php#editar"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
									<a data-toggle="modal" href="lp.php#cancelamento"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
								  </td>
                            </tr>';
					}
				}
			}
		}
	}
	
	public function GetThisCC($id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT cc.id_cc AS ID, cliente.id_clt AS IDCliente, cliente.nome_clt AS NomeCliente, cc.desc_cc AS CentroDeCusto 
			FROM TAB_cc AS cc 
			INNER JOIN TAB_cliente AS cliente ON cc.id_clt = cliente.id_clt 
			WHERE cc.id_cc=:cc";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $id, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC>0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					echo '<option value="'.$result->ID.'">'.$result->CentroDeCusto.'</option>';
				}
			}
		}
	}
	
	public function GetCC($id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT cc.id_cc AS ID, cliente.id_clt AS IDCliente, cliente.nome_clt AS NomeCliente, cc.desc_cc AS CentroDeCusto 
			FROM TAB_cc AS cc 
			INNER JOIN TAB_cliente AS cliente ON cc.id_clt = cliente.id_clt 
			WHERE cliente.id_clt = (SELECT id_clt FROM TAB_cc WHERE id_cc = :cc)";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC>0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					if($id != $result->ID)
					{
						echo '<option value="'.$result->ID.'">'.$result->CentroDeCusto.'</option>';
					}
				}
			}
		}
	}
}
?>