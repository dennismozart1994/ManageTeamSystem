<?php
	class connection
	{
		private static $connector;
		
		// ----- TRY TO CONNECT TO DB -----/
		public static function tryconnect()
		{
			try
			{
				$host = 'localhost';
				$dbname = 'inproject';
				$userdb = 'root';
				$pass = '';
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