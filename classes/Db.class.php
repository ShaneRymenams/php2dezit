<?php

	class Db 
	{
		private static $db;

		public static function getInstance()
		{
			if(self::$db != null)
			{
				return self::$db;
			}
			else
			{
				self::$db = new PDO('mysql:host=localhost; dbname=php2dezit', 'root', '');
				return self::$db;
			}
		}
	}

?>