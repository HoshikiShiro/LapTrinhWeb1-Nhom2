<?php
session_start();
require_once "user.php";
if(isset($_POST['user'])){
	$user1 = new User($_POST['user'],$_POST['pass']);
	if($user1->login($_POST['user'],$_POST['pass'])){
		if(isset($_POST['remember'])){
			setcookie('user',$_POST['user'],time()+3600);
			setcookie('pass',$_POST['pass'],time()+3600);
		}
		$_SESSION['user']=$_POST['user'];
		header("location:index.php");
	}
}
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
<form action="#" method="post">
	Username<input type="text" name="user" value="<?php echo isset($_COOKIE['user'])?$_COOKIE['user']:"" ?>"><br>
	Password<input type="Password" name="pass"><br>
	<input type="checkbox" name="remember">Remember
	<input type="submit" name="" value="Submit">
</form>
</body>
</html>