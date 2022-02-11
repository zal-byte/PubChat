<?php

	class KON{
		private static $instance = null;
		public static function getInstance()
		{
			if(self::$instance == null)
			{
				self::$instance= new KON();
			}
			return self::$instance;
		}
		public static $con;
		public function __construct()
		{
			self::$con = new PDO('mysql:host=localhost;dbname=pubchat','root','');

		}
		public static function getConnection()
		{
			if( self::$con != null )
			{
				return self::$con;
			}else
			{
				self::$con = new PDO('mysql:host=localhost;dbname=pubchat','root','');
				return self::$con;
			}
		}
	}

?>