<?php
	date_default_timezone_set("ASIA/JAKARTA");

	require_once 'kon.php';


	$limit = isset($_GET["limit"]) ? (int) $_GET["limit"] : 5;
    $v = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
	$page = ($v > 1) ? ($v * $limit) - $limit : 0;

	KON::getInstance();
	$con = KON::getConnection();

	session_start();

	function get($con, $page, $limit)
	{
		$query = "SELECT * FROM chats ORDER BY id ASC";

		$pre = $con->prepare($query);
		if($pre->execute())
		{
			?>
			<style type="text/css">
  

  
  input {
    font-family: "Lato";
  }
  
  a {
    color: #0000ff;
    text-decoration: none;
  }
  
  a:hover {
    text-decoration: underline;
  }
  

  	
  #usermsg {
    flex: 1;
    border-radius: 4px;
    border: 1px solid #ff9800;
  }
  
  #name {
    border-radius: 4px;
    border: 1px solid #ff9800;
    padding: 2px 8px;
  }
  
  #enter{
    background: #ff9800;
    border: 2px solid #e65100;
    color: white;
    padding: 4px 10px;
    font-weight: bold;
    border-radius: 4px;
  }
  
  .error {
    color: #ff0000;
  }
  
  #menu {
    padding: 15px 25px;
    display: flex;
  }
  
  #menu p.welcome {
    flex: 1;
  }
  
  a#exit {
    color: white;
    background: #c62828;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: bold;
  }
  
  .msgln {
    margin: 0 0 5px 0;
  }
  
  .msgln span.left-info {
    color: orangered;
  }

  .msgln span.join-info
  {
      color: rgb(0, 181, 226);
  }
  
  .msgln span.chat-time {
    color: #666;
    font-size: 60%;
    vertical-align: super;
  }
  
  .msgln b.user-name, .msgln b.user-name-left {
    font-weight: bold;
    color: white;
    padding: 2px 4px;
    font-size: 90%;
    border-radius: 4px;
    margin: 0 5px 0 0;
  }
  
  .msgln b.user-name-left {
    background: orangered;
  }
  .msgln b.user-name-join{
      background:greenyellow;
  }
			</style>
				<div class="container-fluid">
					<?php
					$data  = $pre->fetchAll(PDO::FETCH_ASSOC);
					for($i = 0; $i < count($data); $i++)
						{
							?>
								<div class="msgln">
									<span class="chat-time">
										<?php echo $data[$i]['time'];?>
									</span>
									<b class="user-name" style="background:<?php echo $data[$i]['color_name'];?>;">
										<?php echo $data[$i]['name'];?>
									</b>
									<?php echo $data[$i]['message'];?>
									<br/>
								</div>
							<?php
						}
					?>
				</div>	
			<?php
		}
	}
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		get($con, $page, $limit);
	}else if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$name = $_POST['name'];
		$msg = $_POST['text'];
		$color = $_POST['color_name'];
		$que = "INSERT INTO chats (`name`,`color_name`,`message`,`time`) VALUES (:name, :color_name, :message, :time)";
		$msg = stripcslashes(htmlentities($msg));
		$pre=$con->prepare($que);
		if($pre->execute([':name'=>$name,':color_name'=>$color,':message'=>$msg, ':time'=>date('Y-m-d H:m:s')]))
		{
			get($con, $page, $limit);
		}


	}



?>
