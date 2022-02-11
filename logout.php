<?php
	date_default_timezone_set("ASIA/JAKARTA");

	require_once 'kon.php';

	KON::getInstance();
	$con = KON::getConnection();


	session_start();

	if(isset($_SESSION['has_enter']))
	{



		

		$query = "INSERT INTO chats (`name`,`color_name`,`message`,`time`) VALUES (:name, :color_name, :message, :time)";

		$pre = $con->prepare($query);
		if($pre->execute([':name'=>'SERVER',':color_name'=>'red',':message'=> "( " .$_SESSION['name'] . " ) Disconnected ",':time'=>date('Y-m-d H:m:s')]))
		{
			unset($_SESSION['has_enter']);
			unset($_SESSION['err_handler']);
			unset($_SESSION['color_name']);

			session_destroy();			
			header("location: index.php");			
		}
	}

?>