<?php
	
	session_start();

	if(isset($_SESSION['has_enter']))
	{
		header("location: chats.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bs5/css/bootstrap.min.css">
	<title>Enter your name</title>
</head>
<body>

<div class="container py-4">
	<center>
	<div class="col-md-3 col-offset-4">
		<div class="card shadow-sm">
			<div class="card-body">
				<h4 class="text-center">
					Enter your name
				</h4>
				<hr>
				<div class="form-group">
					<form method="POST" action="post.php" enctype="multipart/form-data">
						<input type="text" name="name" placeholder="Name" class="form-control" >
						<br/>
						<?php
						if(isset($_SESSION['err_handler'])){
							?>
							<p class="m-2 p-2 bg-danger text-white" style="border-radius: 10px;">
								<?php echo $_SESSION['err_handler'];?>
							</p>
							<?php
						}
						?>
						<p class="text-center">
							Choose user message color
						</p>
						<select name="chooseColor" class="form-control">
							<option  value="---"> --- Choose Color --- </option>
							<option  value="red" style="background-color:red;color:white;" > Red </option>
							<option value="cyan" style="background-color:cyan;color:black;">
							Cyan </option>
							<option value="purple" style="background-color:purple;color:white;"> Purple </option>
						</select>
						<br/>
						<button style="width:100%;" type="submit" class="btn btn-info"> Enter </button>
					</form>
				</div>
			</div>
		</div>
	</div>
	</center>
</div>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="bs5/js/bootstrap.min.js"></script>

</body>
</html>