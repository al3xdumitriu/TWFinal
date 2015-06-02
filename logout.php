<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid=$_SESSION['userid'];
$username=$_SESSION['username'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 tRANSITIONAL//EN" "http://www.w3.org/TR/xhtml1/dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/shtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title> Member System - Member </title>
	<link rel="stylesheet" href="css/bye.css">
</head>
<body>
	<?php
	
	if($userid && $username){
		session_destroy();
		header('Location: ./login.php');
		echo "<h1>You have been logged out! <a href='./login.php'>Login?</a></h1> ";
	}
	else
		header('Location: ./login.php');
		echo "<h1>You are not logged in. <a href='./login.php'>Login!</a></h1>";
	
	?>
</body>

</html>