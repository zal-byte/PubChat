<?php

	session_start();
	date_default_timezone_set("ASIA/JAKARTA");

	if(!isset($_SESSION['has_enter']))
	{
		$_SESSION['err_handler'] = "You must enter your name first";
		header("location: index.php");
	}

	require_once 'kon.php';

	KON::getInstance();
	$con = KON::getConnection();

	if(isset($_SESSION['on_join']))
	{
		$query = "INSERT INTO chats (`name`,`color_name`,`message`,`time`) VALUES (:name, :color_name, :message, :time)";
		$pre = $con->prepare($query);
		if($pre->execute([':name'=>'SERVER', ':color_name'=>'green',':message'=> "( " .$_SESSION['name'] . ' ) Connected.',':time'=>date('Y-m-d H:m:s')]))
		{
			unset($_SESSION['on_join']);
		}
	}


	?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="bs5/css/bootstrap.min.css">
		<title>Welcome, <?php echo $_SESSION['name'];?>.</title>
		<style type="text/css">
			body{
				font-family: 'Lato';
				font-weight: 300;
				background: #041C32;
			}
		</style>
	</head>
	<body>


		<div class="container-fluid d-flex justify-content-center" style="margin-top:25px;">
			<div class="col-md-5 col-offset-4">
				<div class="card shadow-sm" style="background:#04293A;">
					<div class="card-body">
						<div class="d-flex mb-2">
							<p class="text-center text-white" style="flex:1;"> Rules: Freedom, take your own risk.</p>
							<a href="logout.php" ><button class="btn btn-danger"> Leave </button></a>
						</div>
						
						<div id="chatbox" style="background: #f5f5f5; overflow: auto; height: 400px; text-align: left;">

						</div>
						<br/>
						<div class="form-group">
							<form name="message" action="">
								<div class="d-flex">
									<input type="text" id="name" value="<?php echo $_SESSION['name'];?>" hidden>
									<input type="text" id="color_name" value="<?php echo $_SESSION['color_name'];?>" hidden>
									<input type="text" class="form-control" rows="2" id="msg" placeholder="Message" required>
									<button id="send" class="btn btn-success" style="margin-left: 5px;"> Send </button>
								</div>
							</form>

						</div>
					</div>	
				</div>
			</div>
		</div>
	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="bs5/js/bootstrap.min.js"></script>

	<script type="text/javascript">

		$(document).ready(function(){
			$("#send").click(function(){
				var msg = $("#msg").val();
				var name = $("#name").val();
				var color = $("#color_name").val();
				$.ajax({
					url:'cc.php',
					method:'POST',
					data:'text='+msg+'&name='+name+"&color_name="+color,
					success:function(res)
					{
						$("#msg").val("");
         
					}
				})
				return false;
			});

		function loadChats()
		{
            var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request

			$.ajax({
				url: 'cc.php?loadchats=1',
				cache:false,
				success:function(res)
				{
					if( res != null || res != "")
					{
						$("#chatbox").html(res);
							var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
						
					}
				}
			});
		}
		setInterval(loadChats, 500);
		});	
	</script>
	</body>
	</html>

	<?php

?>