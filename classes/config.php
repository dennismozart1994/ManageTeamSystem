<?php
require_once('connection.php');

class config
{
	private static $connector;
	private function setConnector()
	{
		$connect = new connection;
		$connect->tryconnect();
		self::$connector = $connect->getConnector();
	}
	/* ------------------------------ TRUNCATE TABLE ----------------------*/
	/* ------------------------------ PROJECT TABLE ----------------------*/
	public function truncate_projetos()
	{
		$sql = "TRUNCATE tab_projeto";
		self::setConnector();
		$query = self::$connector->prepare($sql);
		try
		{
			if($query->execute())
			{
				return true;
			}
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	/* ------------------------------ HISTORY TABLE ----------------------*/
	public function truncate_historico()
	{
		$sql = "TRUNCATE tab_historico";
		self::setConnector();
		$query = self::$connector->prepare($sql);
		try
		{
			if($query->execute())
			{
				return true;
			}
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	/* ------------------------------ DELETE TABLE ----------------------*/
	/* ------------------------------ REASON TABLE ----------------------*/
	private function DelReasonTable()
	{
		$sql = "DROP TABLE tab_reason";
		self::setConnector();
		$query = self::$connector->prepare($sql);
		try
		{
			if($query->execute())
			{
				return true;
			}
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	/* ------------------------------ TRAINING TABLE --------------------*/
	private function DelTrainingTable()
	{
		$sql = "DROP TABLE tab_treina";
		self::setConnector();
		$query = self::$connector->prepare($sql);
		try
		{
			if($query->execute())
			{
				return true;
			}
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	/* ------------------------------ NOTIFY TABLE ----------------------*/
	private function DelNotifyTable()
	{
		$sql = "DROP TABLE tab_notify";
		self::setConnector();
		$query = self::$connector->prepare($sql);
		try
		{
			if($query->execute())
			{
				return true;
			}
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	/* ------------------------------ CREATE TABLE ----------------------*/
	/* ------------------------------ REASON TABLE ----------------------*/
	public function create_reason_table()
	{
		// TAB_reason MySQL structure
		$sql = "CREATE TABLE `tab_reason` (
		  `id_reason` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `name_reason` varchar(255) NOT NULL,
		  `desc_reason` longtext NOT NULL,
		  `active_reason` int(11) NOT NULL,
		  `id_user` int(11) NOT NULL,
		  `last_update_reason` date NOT NULL
		)";

		if(self::DelReasonTable())
		{
			$query = self::$connector->prepare($sql);
			if($query->execute())
			{
				echo '<script>alert("Tabela de Razões de Cancelamento criada com sucesso!");</script>';
			}
		}
		else
		{
			$query = self::$connector->prepare($sql);
			if($query->execute())
			{
				echo '<script>alert("Tabela de Razões de Cancelamento criada com sucesso!");</script>';
			}
		}
		
	}
	
	/* ------------------------------ TRAINING TABLE --------------------*/
	public function create_training_table()
	{
		// TAB_treina MySQL structure
		$sql = "CREATE TABLE `tab_treina` (
		  `id_treina` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `tema_treina` varchar(255) NOT NULL,
		  `desc_treina` longtext NOT NULL,
		  `local_treina` varchar(255) NOT NULL,
		  `date_treina` date NOT NULL,
		  `time_treina` time NOT NULL,
		  `id_users` varchar(255) NOT NULL
    )";

		if(self::DelTrainingTable())
		{
			$query = self::$connector->prepare($sql);
			if($query->execute())
			{
				echo '<script>alert("Tabela de Treinamentos criada com sucesso!");</script>';
			}
		}
		else
		{
			$query = self::$connector->prepare($sql);
			if($query->execute())
			{
				echo '<script>alert("Tabela de Treinamentos criada com sucesso!");</script>';
			}
		}
	}

	/* ------------------------------ NOTIFY TABLE ----------------------*/
	public function create_notify_table()
	{
		$sql = "CREATE TABLE `tab_notify` (
			  `id_notify` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `id_projeto` int(11) NOT NULL,
			  `id_from_user` int(11) NOT NULL,
			  `id_to_user` int(11) NOT NULL,
			  `status_notify` varchar(255) NOT NULL,
			  `description_notify` varchar(255) NOT NULL,
			  `active_notify` int(11) NOT NULL
			)";
		if(self::DelNotifyTable())
		{
			$query = self::$connector->prepare($sql);
			if($query->execute())
			{
				echo '<script>alert("Tabela Notificações criada com sucesso!");</script>';
			}
		}
		else
		{
			$query = self::$connector->prepare($sql);
			if($query->execute())
			{
				echo '<script>alert("Tabela Notificações criada com sucesso!");</script>';
			}
		}
	}

	/* ------------------------------ ALTER TABLE ----------------------*/
	public function alter_table($string)
	{
		self::setConnector();
		$query = self::$connector->prepare($string);
		if($query->execute())
		{
			echo '<script>alert("Tabela alterada com sucesso!");</script>';
		}
	}
}

?>