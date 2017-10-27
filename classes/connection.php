<?php
	class connection
	{
		private static $connector;
		
		// ----- TRY TO CONNECT TO DB -----/
		public static function tryconnect()
		{
			try
			{
				$host = '10.10.1.37';
				$dbname = 'inproject';
				$userdb = 'root';
				$pass = 'Inmetrics1502';
				$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8","$userdb","$pass");
				$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$connector = $connection;
				return true;
			}
			catch(PDOException $error)
			{
				return false;
			}
			
		}
		
		// ----- RETURN CONNECTION -----/
		
		public static function getConnector()
		{
			return self::$connector;
		}
	}
?>