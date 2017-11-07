<?php
require_once('connection.php');

class config
{
	private static $connector;
	private function setConnector()

	/* ------------------------------ REASON TABLE ----------------------*/
	{
		$connect = new connection;
		$connect->tryconnect();
		self::$connector = $connect->getConnector();
	}

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
}
?>