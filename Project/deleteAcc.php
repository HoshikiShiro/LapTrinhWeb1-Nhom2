<?php
session_start();
session_destroy();
require "data.php";
require "config.php";
if(isset($_POST['usernamead']) && isset($_POST['userpasswordad']))
{
	$user = $_POST['usernamead'];
	$pass = $_POST['userpasswordad'];
	$db= new DB();
	// var_dump($db->getUser());
	if($db->checkAdmin($user,$pass))
	{
		$_SESSION['usernamead'] = $_POST['usernamead'];
		$_SESSION['userpasswordad'] = $_POST['userpasswordad'];
	}else
	{
		echo '<script language="javascript">';
		echo 'alert("Need Administrator account to use this tab")';
		echo '</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mobile Admin</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="public/css/bootstrap.min.css" />
	<link rel="stylesheet" href="public/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="public/css/uniform.css" />
	<link rel="stylesheet" href="public/css/select2.css" />
	<link rel="stylesheet" href="public/css/matrix-style.css" />
	<link rel="stylesheet" href="public/css/matrix-media.css" />
	<link href="public/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

	<!--Header-part-->
	<div id="header">
	</div>

	<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-th"></i>Tables</a>
		<ul>
			<li class=""><a title="" href="login.php"><span class="text">Sign in</span></a></li>
			<li class=""><a title="" href="sign_up.php"><span class="text">Sign up</span></a></li>
			<li class=""><a title="" href="deleteAcc.php"><span class="text">Delete Account</span></a></li>
		</ul>
	</div>

	<?php
		if(!isset($_SESSION['usernamead']) || !isset($_POST['userpasswordad']))
		{
	?>
	<!-- BEGIN CONTENT -->
	<div id="content" >
		<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
			<br><span><b>Username</b></span><input type="text" name="usernamead"><br><br>
			<span><b>Password</b> </span><input type="Password" name="userpasswordad"><br><br>
			<label>
				<input type="submit" name="" value="Submit">
			</label>
		</form>
	</div>

	<!-- END CONTENT -->
	<?php
		}else
		{
	?>
	<div id="content" >
		<form action="login.php" method="post" class="form-horizontal" enctype="multipart/form-data">
			<br><span><b>Delete User</b></span><input type="text" name="usernamedel" value="<?php echo isset($_COOKIE['user'])?$_COOKIE['user']:"" ?>"><br><br>
			<label>
				<input type="submit" name="" value="Delete">
			</label>
		</form>
	</div>
	<?php
		}
	?>
	<!--Footer-part-->
	<div class="row-fluid">
		<div id="footer" class="span12"> 2017 &copy; TDC - Lập trình web 1</div>
	</div>
	<!--end-Footer-part-->
	<script src="public/js/jquery.min.js"></script>
	<script src="public/js/jquery.ui.custom.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
	<script src="public/js/jquery.uniform.js"></script>
	<script src="public/js/select2.min.js"></script>
	<script src="public/js/jquery.dataTables.min.js"></script>
	<script src="public/js/matrix.js"></script>
</body>
</html>
