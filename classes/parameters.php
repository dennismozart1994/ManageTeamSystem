<?php
require_once('connection.php');

class parameters
{
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
			WHERE LP.id_clt = (SELECT id_clt FROM TAB_cc WHERE id_cc=:cc)";
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
					if($type = "select")
					{
						if($exception != $id_lp)
						{
							echo '<option value="'.$id_lp.'">'.utf8_encode($nome).'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_lp.'</td>
                                  <td>'.utf8_encode($nome).'</td>
                                  <td>'.utf8_encode($email).'</td>
                                  <td>'.utf8_encode($cliente).'</td>
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
			WHERE LC.id_clt = (SELECT id_clt FROM TAB_cc WHERE id_cc=:cc)";
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
					if($type = "select")
					{
						if($id_lc != $exception)
						{
							echo '<option value="'.$id_lc.'">'.utf8_encode($nome).'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_lc.'</td>
                                  <td>'.utf8_encode($nome).'</td>
                                  <td>'.utf8_encode($email).'</td>
                                  <td>'.utf8_encode($cliente).'</td>
								  <td>
									<a data-toggle="modal" href="ltm.php#editar"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
									<a data-toggle="modal" href="ltm.php#cancelamento"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
								  </td>
                            </tr>';
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
			WHERE user.id_CC =:cc";
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
					if($type = "select")
					{
						if($id_user != $exception)
						{
							echo '<option value="'.$id_user.'">'.utf8_encode($nome).'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_user.'</td>
                                  <td>'.utf8_encode($nome).'</td>
                                  <td>'.utf8_encode($email).'</td>
                                  <td>'.utf8_encode($cc).'</td>
								  <td>'.utf8_encode($funcao).'</td>
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
					if($type = "select")
					{
						if($id_phase != $exception)
						{
							echo '<option value="'.$id_phase.'">'.utf8_encode($nome).'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_phase.'</td>
                                  <td>'.utf8_encode($nome).'</td>
                                  <td>'.utf8_encode($description).'</td>
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
					if($type = "select")
					{
						if($id_status != $exception)
						{
							echo '<option value="'.$id_status.'">'.utf8_encode($nome).'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_status.'</td>
                                  <td>'.utf8_encode($nome).'</td>
                                  <td>'.utf8_encode($description).'</td>
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
					if($type = "select")
					{
						if($id_mtp != $exception)
						{
							echo '<option value="'.$id_mtp.'">'.utf8_encode($nome).'</option>';
						}
					}
					else
					{
						echo '<tr>
                                  <td class="numeric">'.$id_mtp.'</td>
                                  <td>'.utf8_encode($nome).'</td>
                                  <td>'.utf8_encode($description).'</td>
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
}
?>