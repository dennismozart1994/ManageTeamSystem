<?php
require_once('connection.php');

class parameters
{
	private static $client;
	public $users = array();
	/* ----------------------------------- INSERT METHODS --------------------------------------*/
	// INSERT CLIENT LEADER
	public function InsertLTM($type, $name, $email, $responsable)
	{
		
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			if($type == 1)
			{
				$getclient="SELECT id_clt FROM tab_cc WHERE id_cc=:cc";
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
						$sql = "INSERT INTO tab_lider_cliente(id_clt, nome_lc, email_lc, id_user) VALUES (?, ?, ?, ?)";
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
				$getclient="SELECT id_clt FROM tab_cc WHERE id_cc=:cc";
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
						$sql = "INSERT INTO tab_lider_projeto(id_clt, nome_lp, email_lp, id_user) VALUES (?, ?, ?, ?)";
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

// Cancel Reason
	public function InsertCancelReason($name, $desc, $user)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "INSERT INTO tab_reason(name_reason, desc_reason, id_user, last_update_reason) VALUES (:name, :description, :user, NOW())";
			$query = $connector->prepare($sql);
			$query->bindParam(':name', $name, PDO::PARAM_STR);
			$query->bindParam(':description', $desc, PDO::PARAM_STR);
			$query->bindParam(':user', $user, PDO::PARAM_INT);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC>0)
			{
				echo '<script>alert("Parâmetro adicionado com sucesso!"); window.location.href = "clr.php";</script>';
			}
			else
			{
				echo '<script>alert("Erro ao conectar com o banco de dados!"); window.location.href = "clr.php";</script>';
			}
		}
		else
		{
			echo '<script>alert("Erro ao conectar com o banco de dados!"); window.location.href = "clr.php";</script>';
		}
	}

	public function InsertTraining($theme, $description, $local, $date, $time, $responsables)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "INSERT INTO tab_treina(tema_treina, desc_treina, local_treina, date_treina, time_treina, id_users) VALUES(:theme, :descrip, :place, :schedule, :hour, :responsable)";
			$query = $connector->prepare($sql);
			$query->bindParam(':theme', $theme, PDO::PARAM_STR);
			$query->bindParam(':descrip', $description, PDO::PARAM_STR);
			$query->bindParam(':place', $local, PDO::PARAM_STR);
			$query->bindParam(':schedule', $date, PDO::PARAM_STR);
			$query->bindParam(':hour', $time, PDO::PARAM_STR);
			$query->bindParam(':responsable', $responsables, PDO::PARAM_STR);
			if($query->execute())
			{
				echo '<script>alert("Treinamento inserido com sucesso!"); window.location.href = "trainings.php";</script>';
			}
			else
			{
				echo '<script>alert("Erro ao cadastrar treinamento! Tente novamente!"); window.location.href = "trainings.php";</script>';
			}
		}
	}

	/* --------------------------------- UPDATE METHODS -------------------------------------------------------*/
	//DELETE CLIENT LEADER
	public function DeleteLTM($type, $id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			if($type == 1)
			{
				$connector = $connect->getConnector();
				$sql = "UPDATE tab_lider_cliente SET active_lc=1 WHERE id_lc=:id";
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
				$sql = "UPDATE tab_lider_projeto SET active_lp=1 WHERE id_lp=:id";
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
				$sql = "UPDATE tab_lider_cliente SET nome_lc=?, email_lc=?, id_user=? WHERE id_lc=?";
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
				$sql = "UPDATE tab_lider_projeto SET nome_lp=?, email_lp=?, id_user=? WHERE id_lp=?";
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

	public function UpdateCancelReason($id, $name, $description)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "UPDATE tab_reason SET name_reason=:name, desc_reason=:description, id_user=:user, last_update_reason=NOW() WHERE id_reason=:reason";
			$query = $connector->prepare($sql);
			$query->bindParam(':name', $name, PDO::PARAM_STR);
			$query->bindParam(':description', $description, PDO::PARAM_STR);
			$query->bindParam(':user', $_SESSION['id'], PDO::PARAM_INT);
			$query->bindParam(':reason', $id, PDO::PARAM_INT);
			if($query->execute())
			{
				echo '<script>alert("Parâmetro alterado com sucesso! Os projetos já cancelados por esse parâmetro serão alocados na categoria \"Outros\""); window.location.href = "clr.php";</script>';
			}
			else
			{
				echo '<script>alert("Erro ao efetuar alteração do parâmetro! Tente novamente!"); window.location.href = "clr.php";</script>';
			}
		}
		else
		{
			echo '<script>alert("Erro ao conectar com o banco de dados! Tente novamente!"); window.location.href = "clr.php";</script>';
		}
	}

	public function UpdateTraining($id, $theme, $description, $local, $date, $time, $responsables)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "UPDATE tab_treina SET tema_treina=:theme, desc_treina=:descrip, local_treina=:place, date_treina=:schedule, time_treina=:hour, id_users=:responsable WHERE id_treina=:id";
			$query = $connector->prepare($sql);
			$query->bindParam(':theme', $theme, PDO::PARAM_STR);
			$query->bindParam(':descrip', $description, PDO::PARAM_STR);
			$query->bindParam(':place', $local, PDO::PARAM_STR);
			$query->bindParam(':schedule', $date, PDO::PARAM_STR);
			$query->bindParam(':hour', $time, PDO::PARAM_STR);
			$query->bindParam(':responsable', $responsables, PDO::PARAM_STR);
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			if($query->execute())
			{
				echo '<script>alert("Dados alterados com sucesso!"); window.location.href = "trainings.php";</script>';
			}
			else
			{
				echo '<script>alert("Erro ao alterar treinamento! Tente novamente!"); window.location.href = "trainings.php";</script>';
			}
		}
	}
	/* ----------------------------------- DELETE METHODS -----------------------------------*/
	// Cancel reason
	public function DeleteCancelReason($id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "DELETE FROM tab_reason WHERE id_reason=:reason";
			$query = $connector->prepare($sql);
			$query->bindParam(':reason', $id, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0)
			{
				echo '<script>alert("Parâmetro excluído com sucesso! A partir de agora, todos os projetos cancelados por esse motivo de cancelamento se enquadrarão na categoria \"Outros\" "); window.location.href = "clr.php";</script>';
			}
			else
			{
				echo '<script>alert("Erro ao efetuar exclusão do parâmetro! Tente novamente!"); window.location.href = "clr.php";</script>';
			}
		}
		else
		{
			echo '<script>alert("Erro ao conectar com o banco de dados! Tente novamente!"); window.location.href = "clr.php";</script>';
		}
		
	}
	// Training
	public function DeleteTraining($id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "DELETE FROM tab_treina WHERE id_treina=:treina";
			$query = $connector->prepare($sql);
			$query->bindParam(':treina', $id, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0)
			{
				echo '<script>alert("Treinamento excluído com sucesso!"); window.location.href = "trainings.php";</script>';
			}
			else
			{
				echo '<script>alert("Erro ao efetuar exclusão do treinamento! Tente novamente!"); window.location.href = "trainings.php";</script>';
			}
		}
		else
		{
			echo '<script>alert("Erro ao conectar com o banco de dados! Tente novamente!"); window.location.href = "trainings.php";</script>';
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
			FROM tab_lider_projeto AS LP 
			INNER JOIN tab_cliente AS CLT ON LP.id_clt = CLT.id_clt 
			WHERE LP.id_clt = (SELECT id_clt FROM tab_cc WHERE id_cc=:cc) AND LP.active_lp = 0";
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

	public function apply_filter($name)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();

			$sql = "SELECT * FROM tab_reason WHERE name_reason LIKE CONCAT('%', :name, '%')";
			$query = $connector->prepare($sql);
			$query->bindParam(':name', $name, PDO::PARAM_STR);
			$query->execute();
			if($query->rowCount() > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id = $result->id_reason;
					$name = $result->name_reason;
					$description = $result->desc_reason;

					echo '<tr>
                              <td class="numeric">'.$id.'</td>
                              <td>'.$name.'</td>
                              <td>'.$description.'</td>
							  <td>
								<a data-toggle="modal" href="clr.php#editar'.$id.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
								<a data-toggle="modal" href="clr.php#cancelamento'.$id.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
							  </td>
                        </tr>';
				}
			}
		}
	}

	public function apply_filterLP($name)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT LP.id_lp AS ID, LP.nome_lp AS Nome, LP.email_lp AS Email, 
			CLT.nome_clt AS NomeCliente
			FROM tab_lider_projeto AS LP 
			INNER JOIN tab_cliente AS CLT ON LP.id_clt = CLT.id_clt 
			WHERE LP.id_clt = (SELECT id_clt FROM tab_cc WHERE id_cc=:cc) AND LP.active_lp = 0 AND LP.nome_lp LIKE CONCAT('%', :name, '%')";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_INT);
			$query->bindParam(':name', $name, PDO::PARAM_STR);
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

	public function apply_filterLTM($name)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT LC.id_lc AS ID, LC.nome_lc AS Nome, LC.email_lc AS Email, 
			CLT.nome_clt AS NomeCliente
			FROM tab_lider_cliente AS LC 
			INNER JOIN tab_cliente AS CLT ON LC.id_clt = CLT.id_clt 
			WHERE LC.id_clt = (SELECT id_clt FROM tab_cc WHERE id_cc=:cc) AND LC.active_lc = 0 AND LC.nome_lc LIKE CONCAT('%', :name, '%')";
			$query = $connector->prepare($sql);
			$query->bindParam(':cc', $_SESSION['cc'], PDO::PARAM_STR);
			$query->bindParam(':name', $name, PDO::PARAM_STR);
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
	
	public function getLTM($type, $exception)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT LC.id_lc AS ID, LC.nome_lc AS Nome, LC.email_lc AS Email, 
			CLT.nome_clt AS NomeCliente
			FROM tab_lider_cliente AS LC 
			INNER JOIN tab_cliente AS CLT ON LC.id_clt = CLT.id_clt 
			WHERE LC.id_clt = (SELECT id_clt FROM tab_cc WHERE id_cc=:cc) AND LC.active_lc = 0";
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
				FROM tab_lider_cliente AS LC 
				INNER JOIN tab_cliente AS CLT ON LC.id_clt = CLT.id_clt 
				WHERE LC.id_clt = (SELECT id_clt FROM tab_cc WHERE id_cc=:cc) AND LC.active_lc = 0";
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
											<input class="form-control" type="text" required name="nameuser" value="'.$nome.'"/>
											<p><br/>E-mail</p>
											<input class="form-control" required type="email" name="emailuser" value="'.$email.'"/>
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
				FROM tab_lider_projeto AS LP 
				INNER JOIN tab_cliente AS CLT ON LP.id_clt = CLT.id_clt 
				WHERE LP.id_clt = (SELECT id_clt FROM tab_cc WHERE id_cc=:cc)  AND LP.active_lp = 0";
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
											<input class="form-control" type="text" name="nameuser" required value="'.$nome.'"/>
											<p><br/>E-mail</p>
											<input class="form-control" type="email" name="emailuser" required value="'.$email.'"/>
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

	public function getEditCancelReasonModal()
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT RS.id_reason AS ID, RS.name_reason AS Nome, RS.desc_reason AS Description, 
			RS.id_user AS User	FROM tab_reason AS RS WHERE RS.active_reason=0";
			$query = $connector->prepare($sql);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id = $result->ID;
					$nome = $result->Nome;
					$desc = $result->Description;
					echo '
						<!-- Modal Editar Líder-->
						  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editar'.$id.'" class="modal fade">
							<form method="post" action="">
							  <div class="modal-dialog">
								  <div class="modal-content">
									  <div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h4 class="modal-title">Editar dados do Líder de Testes e Mudanças?</h4>
									  </div>
									  <div class="modal-body">
										<input id="id" name="id" type="hidden" value="'.$id.'">
										<p>Nome</p>
										<input class="form-control" type="text" required name="name" value="'.$nome.'"/>
										<p><br/>E-mail</p>
										<textarea class="form-control" rows="5" id="comment" name="description">'.$desc.'</textarea>
									  </div>
									  <div class="modal-footer">
										  <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
										  <button class="btn btn-theme" type="submit" name="save">Salvar</button>
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
				FROM tab_lider_cliente AS LC 
				INNER JOIN tab_cliente AS CLT ON LC.id_clt = CLT.id_clt 
				WHERE LC.id_clt = (SELECT id_clt FROM tab_cc WHERE id_cc=:cc) AND LC.active_lc = 0";
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
				FROM tab_lider_projeto AS LP 
				INNER JOIN tab_cliente AS CLT ON LP.id_clt = CLT.id_clt 
				WHERE LP.id_clt = (SELECT id_clt FROM tab_cc WHERE id_cc=:cc) AND LP.active_lp = 0";
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

	public function getCancelReasons_DeleteModal()
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT RS.id_reason AS ID FROM tab_reason AS RS WHERE RS.active_reason=0";
			$query = $connector->prepare($sql);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id = $result->ID;
					echo '
						<!-- Modal cancelamento-->
						  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="cancelamento'.$id.'" class="modal fade">
							<form method="post" action="">
							  <div class="modal-dialog">
								  <div class="modal-content">
									  <div class="modal-header">
										  <input id="delete" name="delete" type="hidden" value="'.$id.'">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h4 class="modal-title">Tem certeza que deseja excluir esse parâmetro?</h4>
									  </div>
									  <div class="modal-footer">
										  <button data-dismiss="modal" class="btn btn-default" type="button">Não</button>
										  <button class="btn btn-theme" type="submit" name="delete_parameter">Sim</button>
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
	// GetTraining Info
	public function GetTrainingInfo($id, $field)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT * FROM tab_treina WHERE id_treina=:filter";
			$query = $connector->prepare($sql);
			$query->bindParam(':filter', $id, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0)
			{
				$responsables = "";
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$return = $result->$field;
				}
				return $return;
			}
		}
	}

	// View Training detail
	public function ViewTraining($id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT T.id_treina AS ID, T.tema_treina AS Tema, T.desc_treina AS Descricao, T.local_treina AS Local, T.date_treina AS Data, T.time_treina AS Horario, T.id_users AS Usuarios FROM tab_treina AS T WHERE T.id_treina=:filter";
			$query = $connector->prepare($sql);
			$query->bindParam(':filter', $id, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0)
			{
				$responsables = "";
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id = $result->ID;
					$theme = $result->Tema;
					$description = $result->Descricao;
					$local = $result->Local;
					$date = $result->Data;
					$time = $result->Horario;
					$users = explode("_", $result->Usuarios);

					foreach ($users as $value) 
					{
						if($value != "start")
						{
							$getUsers = "SELECT nome_user AS Nome FROM tab_user WHERE id_user=:id";
							$queryname = $connector->prepare($getUsers);
							$queryname->bindParam(':id', $value, PDO::PARAM_STR);
							$queryname->execute();
							if($queryname->rowCount() > 0)
							{
								while($resultname = $queryname->FETCH(PDO::FETCH_OBJ))
								{
									if($responsables == "")
									{
										$responsables = '<p class="col-lg-12 col-sm-12">'.$resultname->Nome.'</p>';
									}
									else
									{
										$responsables = $responsables.'<p class="col-lg-12 col-sm-12">'.$resultname->Nome.'</p>';
									}
								}
							}
						}
					}

					// Show
					echo '
							<h3><i class="fa fa-angle-right"></i>'.$theme.'</h3>
				            <div class="row mt">
				              <div class="col-lg-12">
				      					<div class="form-panel">
				      						<form class="form-horizontal style-form" method="post"> 
				                    <div class="form-group">
				                      <label class="col-lg-12 col-sm-12 control-label"><h4>Descrição</h4></label>
				                        <p class="col-lg-12 col-sm-12">'.$description.'</p>
				                    </div>

				                    <div class="form-group">
				                      <label class="col-lg-12 col-sm-12 control-label"><h4>Data</h4></label>
				                        <p class="col-lg-12 col-sm-12">'.date('d-m-Y', strtotime($date)).' às '.$time.'</p>
				                    </div> 

				                    <div class="form-group">
				                      <label class="col-lg-12 col-sm-12 control-label"><h4>Local</h4></label>
				                        <p class="col-lg-12 col-sm-12">'.$local.'</p>
				                    </div>

				      						  <div class="form-group">
				                      <label class="col-lg-12 col-sm-12 control-label"><h4>Analistas inmetrics que aplicarão o treinamento:</h4></label>
				                      '.$responsables.'
				                    </div>
				                  </form>
				      					</div>
				              </div>
				            </div>';
				}
			}
		}
	}
	// Show all trainings
	public function ListTrainings()
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT T.id_treina AS ID, T.tema_treina AS Tema, T.date_treina AS Data, T.time_treina AS Horario, T.id_users AS Usuarios FROM tab_treina AS T";
			$query = $connector->prepare($sql);
			$query->execute();
			if($query->rowCount() > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$responsables = "";
					$id = $result->ID;
					$theme = $result->Tema;
					$date = $result->Data;
					$time = $result->Horario;
					$users = explode("_", $result->Usuarios);

					foreach ($users as $value) 
					{
						if($value != "start")
						{
							$getUsers = "SELECT nome_user AS Nome FROM tab_user WHERE id_user=:id";
							$queryname = $connector->prepare($getUsers);
							$queryname->bindParam(':id', $value, PDO::PARAM_STR);
							$queryname->execute();
							if($queryname->rowCount() > 0)
							{
								while($resultname = $queryname->FETCH(PDO::FETCH_OBJ))
								{
									if($responsables == "")
									{
										$responsables = $resultname->Nome;
									}
									else
									{
										$responsables = $responsables." / ".$resultname->Nome;
									}
								}
							}
						}
					}
						echo '<tbody>
			                    <tr>
			                        <td>'.$theme.'</td>
			                        <td>'.$responsables.'</td>
			                        <td>'.date('d-m-Y', strtotime($date)).' às '.$time.'</td>
			                        <td>
			                        	<a data-toggle="modal" href="newtraining.php?v='.$id.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
			                        	<a href="viewtraining.php?v='.$id.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>
			                        	<a data-toggle="modal" href="trainings.php#cancelamento'.$id.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
			                        </td>
			                    </tr>
			                  </tbody>';
				}
			}

		}
	}
	// Apply training filter
	public function FilterTrainings($filter)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$apply = date('Y-m-d', strtotime($filter));
			$connector = $connect->getConnector();
			$sql = "SELECT T.id_treina AS ID, T.tema_treina AS Tema, T.date_treina AS Data, T.time_treina AS Horario, T.id_users AS Usuarios FROM tab_treina AS T WHERE T.date_treina=:data";
			$query = $connector->prepare($sql);
			$query->bindParam(':data', $apply, PDO::PARAM_STR);
			$query->execute();
			if($query->rowCount() > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$responsables = "";
					$id = $result->ID;
					$theme = $result->Tema;
					$date = $result->Data;
					$time = $result->Horario;
					$users = explode("_", $result->Usuarios);

					foreach ($users as $value) 
					{
						if($value != "start")
						{
							$getUsers = "SELECT nome_user AS Nome FROM tab_user WHERE id_user=:id";
							$queryname = $connector->prepare($getUsers);
							$queryname->bindParam(':id', $value, PDO::PARAM_STR);
							$queryname->execute();
							if($queryname->rowCount() > 0)
							{
								while($resultname = $queryname->FETCH(PDO::FETCH_OBJ))
								{
									if($responsables == "")
									{
										$responsables = $resultname->Nome;
									}
									else
									{
										$responsables = $responsables." / ".$resultname->Nome;
									}
								}
							}
						}
					}
						echo '<tbody>
			                    <tr>
			                        <td>'.$theme.'</td>
			                        <td>'.$responsables.'</td>
			                        <td>'.date('d-m-Y', strtotime($date)).' às '.$time.'</td>
			                        <td>
			                        	<a data-toggle="modal" href="newtraining.php?v='.$id.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
			                        	<a href="viewtraining.php?v='.$id.'"><button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button></a>
			                        	<a data-toggle="modal" href="trainings.php#cancelamento'.$id.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
			                        </td>
			                    </tr>
			                  </tbody>';
				}
			}

		}
	}
	
	// Edit Training
	public function GetTrainingAnalyst($exception)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$id_usersfounded = array();
			$name_usersfounded = array();
			$users = explode("_", $exception);
			$connector = $connect->getConnector();
			$sql = "SELECT user.id_user AS ID, user.nome_user AS Nome, user.email_in_user AS Email, user.funcao_user AS Funcao, 
			CC.desc_cc AS CentroDeCusto
			FROM tab_user AS user 
			INNER JOIN tab_cc AS CC ON user.id_cc = CC.id_cc 
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

					// Update list of active users
					if(array_key_exists(0, $this->users))
					{
						array_push($this->users, 'user'.$id_user);
					}
					else
					{
						$this->users = array('user'.$id_user);
					}

					// add id users to personal array
					if(array_key_exists(0, $id_usersfounded))
					{
						array_push($id_usersfounded, $id_user);
					}
					else
					{
						$id_usersfounded = array($id_user);
					}
					// add usernames to personal array
					if(array_key_exists(0, $name_usersfounded))
					{
						array_push($name_usersfounded, $nome);
					}
					else
					{
						$name_usersfounded = array($nome);
					}
				}

				// loop through id usernames to print checkboxes
				foreach ($id_usersfounded as $key => $value) 
				{
					if(in_array($value, $users))
					{
						echo '<div class="checkbox">
							  <label>
							    <input type="checkbox" name="user'.$value.'" checked value="'.$value.'">
							    '.$name_usersfounded[$key].'
							  </label>
							</div>';
					}
					else
					{
						echo '<div class="checkbox">
							  <label>
							    <input type="checkbox" name="user'.$value.'" value="'.$value.'">
							    '.$name_usersfounded[$key].'
							  </label>
							</div>';
					}
				}
			}
		}
	}
	// Get Training delete modal
	public function getTrainings_DeleteModal()
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT T.id_treina AS ID FROM tab_treina AS T";
			$query = $connector->prepare($sql);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id = $result->ID;
					echo '
						<!-- Modal cancelamento-->
						  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="cancelamento'.$id.'" class="modal fade">
							<form method="post" action="">
							  <div class="modal-dialog">
								  <div class="modal-content">
									  <div class="modal-header">
										  <input id="delete" name="delete" type="hidden" value="'.$id.'">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h4 class="modal-title">Tem certeza que deseja excluir esse treinamento?</h4>
									  </div>
									  <div class="modal-footer">
										  <button data-dismiss="modal" class="btn btn-default" type="button">Não</button>
										  <button class="btn btn-theme" type="submit" name="delete_training">Sim</button>
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

	public function getAnalyst($type, $exception)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT user.id_user AS ID, user.nome_user AS Nome, user.email_in_user AS Email, user.funcao_user AS Funcao, 
			CC.desc_cc AS CentroDeCusto
			FROM tab_user AS user 
			INNER JOIN tab_cc AS CC ON user.id_cc = CC.id_cc 
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
					else if($type == "check")
					{
						if($id_user != $exception)
						{	
							if(array_key_exists(0, $this->users))
							{
								array_push($this->users, 'user'.$id_user);
							}
							else
							{
								$this->users = array('user'.$id_user);
							}
							
							echo '<div class="checkbox">
								  <label>
								    <input type="checkbox" name="user'.$id_user.'" value="'.$id_user.'">
								    '.$nome.'
								  </label>
								</div>';
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
			FROM tab_fases AS fases";
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
			FROM tab_fases AS fases WHERE fases.id_f=:phase";
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

	public function getOneStatus($statusid)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT status.id_status AS ID, status.nome_status AS Nome, status.desc_status AS Descricao
			FROM tab_status AS status WHERE status.id_status=:status";
			$query = $connector->prepare($sql);
			$query->bindParam(':status', $statusid, PDO::PARAM_INT);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id_status = $result->ID;
					$nome = $result->Nome;
					$description = $result->Descricao;
					echo '<option value="'.$id_status.'">'.$nome.'</option>';
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
			FROM tab_status AS status";
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
			FROM tab_mot_pend AS Pendencia";
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

	public function getCancelReasons($type, $exception)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "SELECT reason.id_reason AS ID, reason.name_reason AS Nome, reason.desc_reason AS Descricao
			FROM tab_reason AS reason WHERE active_reason = 0";
			$query = $connector->prepare($sql);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC > 0)
			{
				while($result = $query->FETCH(PDO::FETCH_OBJ))
				{
					$id = $result->ID;
					$name = $result->Nome;
					$description = $result->Descricao;
					if($type == "select")
					{
						if($name != $exception)
						{
							echo '<option value="'.$name.'">'.$name.'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id.'</td>
                                  <td>'.$name.'</td>
                                  <td>'.$description.'</td>
								  <td>
									<a data-toggle="modal" href="clr.php#editar'.$id.'"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
									<a data-toggle="modal" href="clr.php#cancelamento'.$id.'"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
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
			FROM tab_cc AS cc 
			INNER JOIN tab_cliente AS cliente ON cc.id_clt = cliente.id_clt 
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
			FROM tab_cc AS cc 
			INNER JOIN tab_cliente AS cliente ON cc.id_clt = cliente.id_clt 
			WHERE cliente.id_clt = (SELECT id_clt FROM tab_cc WHERE id_cc = :cc)";
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