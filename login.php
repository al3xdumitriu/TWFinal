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
	<title> Member System - Login </title>
	<link rel="stylesheet" href="css/reset.css">

    <link rel='stylesheet prefetch' href='http://daneden.github.io/animate.css/animate.min.css'>
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,400italic,700italic,700'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
	
	if($userid && $username){
		header('Location: ./home.php');
		echo "<div class='welcome'><h1>You are already logged in as $username . Go to the <a href='./home.php'>member page</a> or <a href='./logout.php'>logout </a></h1></div> ";
		
	}
	else{
	$form="
	   <div class='info'>
  <h1>News in Computer Science</h1>
  <span>
    Made with
    <i class='fa fa-heart animated infinite pulse'></i>
    by Alex
    <div class='spoilers'>
        (Very Cool!) 
    </div>
  </span>
</div>
<div class='form aniamted bounceIn'>
  
  <div class='login'>
    <h2>Login To Your Account</h2>
    <form action='./login.php' method='post'>
      <input placeholder='Username' type='text' name='user'>
      <input placeholder='Password' type='password' name='password'>
      <input type='submit' name='loginbtn' value='Login' id='butt'>
    </form>
  </div>
  
  <footer>
  <a href='./register.php'>Register</a>
  </footer>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    
    <script src=\"js/index.js\"></script>
	<script type='text/javascript'>
    $(function(){
        $('#center').css({'height':(($(document).height())-162)+'px'});

        $(window).resize(function(){
        $('#center').css({'height':(($(document).height())-162)+'px'});
        });
    });
</script>
";

	
	if ($_POST['loginbtn']){
		$user = $_POST['user'];
		$password = $_POST['password'];
		if($user){
			if($password){
				
				//require("connect.php");
				

			$conn=oci_connect("Alex","Johnc3naa","localhost/xe");
			if (!$conn)
			echo 'Failed to connect to Oracle';

				//$con=mysqli_connect($host_name ,$user_name ,$password_connection,$database) or die("Error " .       mysqli_error($con));
				//check connection

				//echo "Connection opened";
	
				$password=md5(md5("dh2gfd".$password."DG43gfd"));
				
				
				
				$query = ociparse($conn,"SELECT * FROM users WHERE username='$user'");
				ociexecute($query);
				
				
				   if(ociexecute($query))
    {
		$gasit=0;
		$logat=0;
        while (ocifetch($query)) 
        {     
			$gasit=1;
            $dbid = ociresult($query, "ID");
			$dbuser = ociresult($query, "USERNAME");
			$dbpass = ociresult($query, "PASSWORD");
			$dbactive = ociresult($query, "ACTIVE");
            //echo "<td>".$dbuser."</td>";
            //echo '<br />';
             if ($password==$dbpass ){
				if($dbactive==1){
					$_SESSION['userid']=$dbid;
					$_SESSION['username']=$dbuser;
					$_SESSION['pagina']=1;
					$_SESSION['format']="";
					$_SESSION['sosearch']="";
					$_SESSION['solimba']="";
					$_SESSION['sodomeniu']="";
					$_SESSION['soformat']="";
					$_SESSION['engineeringsearch']="";
					$_SESSION['engineeringlimba']="";
					$_SESSION['engineeringdomeniu']="";
					$_SESSION['engineeringformat']="";					
					$_SESSION['gamessearch']="";
					$_SESSION['gameslimba']="";
					$_SESSION['gamesdomeniu']="";
					$_SESSION['gamesformat']="";
					$_SESSION['languagessearch']="";
					$_SESSION['languageslimba']="";
					$_SESSION['languagesdomeniu']="";
					$_SESSION['languagesformat']="";
					$_SESSION['technologiessearch']="";
					$_SESSION['technologieslimba']="";
					$_SESSION['technologiesdomeniu']="";
					$_SESSION['technologiesformat']="";
					$_SESSION['tradesearch']="";
					$_SESSION['tradelimba']="";
					$_SESSION['tradedomeniu']="";
					$_SESSION['tradeformat']="";
					$_SESSION['generalsearch']="";
					$_SESSION['generallimba']="";
					$_SESSION['generaldomeniu']="";
					$_SESSION['generalformat']="";
					$logat=1;
					header('Location: ./home.php');
					echo "<div class='welcome'><h1>You have been logged in as  <b>$dbuser</b>  Click <a href='./home.php'>here</a> to go to the memberpage</h1></div>";
					
				}else
					echo "<div class='welcome'><h1>you must activate your account to login.</h1></div>";
			 }
			 else 
				 echo "Combinatia user-parola nu este valida!";
            
        }
		if ($gasit==0) echo "Combinatia user-parola nu este valida!.$form";
		else if ($logat==0) echo "$form";
    }
    else
    {
	$e = oci_error($query); 
        echo htmlentities($e['message']);
    }
				
			
			
			
				oci_close($conn);
				
			}else 
				echo "No password!$form";
		}
		else 
			echo "No username!$form";
	}
	else 
		echo $form;
	}
	?>
</body>

</html>