<?php
	
	require_once 'kon.php';

	KON::getInstance();

	session_start();

	$con = KON::getConnection();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_POST['name']))
		{
			$name = $_POST['name'];

			if($name != "" )
			{
				if( strlen($name) > 2 )
				{

					$default_color = "black";

					if(isset($_POST['chooseColor']))
					{
						if($_POST['chooseColor'] == '---')
						{
							$_SESSION['color_name'] = $default_color;
						}else
						{
							$_SESSION['color_name'] = $_POST['chooseColor'];
						}
					}
					$_SESSION['name'] = $name;
					$_SESSION['has_enter'] = true;
					$_SESSION['on_join'] = true;
					header("location: chats.php");
				}else
				{
					$_SESSION['err_handler'] = "Max character is 1 !";
					header("location: index.php");

				}
			}else
			{
				$_SESSION['err_handler'] = "Make sure you are input your name.";
				header("location: index.php");
			}

		}
	}

?>