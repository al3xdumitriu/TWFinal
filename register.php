<?php
error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 tRANSITIONAL//EN" "http://www.w3.org/TR/xhtml1/dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/shtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title> Member System - Member </title>
		<link rel="stylesheet" href="css/reset.css">

    <link rel='stylesheet prefetch' href='http://daneden.github.io/animate.css/animate.min.css'>
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,400italic,700italic,700'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
	
	if( $_POST['registerbtn']){
		$getuser = $_POST['user'];
		$getemail = $_POST['email'];
		$getpass = $_POST['password'];
		$getretypepass = $_POST['retypepass'];
		$getinterest = $_POST['interest'];
		if($getuser){
			if($getemail){
				if($getpass){
					if(strlen($getpass)>8){
					if($getretypepass){
						if($getpass === $getretypepass){
				
							if( (strlen($getemail) > 7) && (strstr($getemail,"@")) && (strstr($getemail,"."))){
								
								if($getinterest){
								
								$conn=oci_connect("Alex","Johnc3naa","localhost/xe");
								if (!$conn)
									echo 'Failed to connect to Oracle';
								else 
									echo 'Succesfully connected with Oracle DB<br />';
							
								$query = ociparse($conn,"SELECT * FROM users WHERE username='$getuser'");
							
				
				
								if(ociexecute($query))
								{
									
									if (ocifetch($query)) 
									{     
										$errormsg=  "Utilizatorul exista deja ";
									}
									else{ 
									
										$query = ociparse($conn,"SELECT * FROM users WHERE email='$getemail'");
										
				
				
										if(ociexecute($query))
										{
									
											if (ocifetch($query)) 
											{     
												$errormsg= "Acest email exista deja ";
											}
											else{ 
									
											
												
												$password = md5(md5("dh2gfd".$getpass."DG43gfd"));
												$date = date("F d,Y");
												$code = md5(rand());
																								
														$query = ociparse($conn,"INSERT INTO users VALUES(
															'','$getuser','$password','$getemail','1','$code',sysdate,'$getinterest',0
														)");
														
														if(ociexecute($query))
														{
															header('Location: ./login.php');
															echo "s-au inserat datele in tabela";
															
														//	$site = "http://localhost/TW";
														//	$webmaster = "alex <al3xdumitriu@yahoo.com>";
														//	$headers = "From: $webmaster";
														//	$subject = "Activate Your Account";
														//	$message = "Thanks for registering .Click the link to activate your account.\n $site/activate.php?user=$getuser&code=$code";
															
														//	if(mail($getemail,$subject,$message,$headers){
														//		$errormsg = "An email has been sent to confirm your registration!";
														//		$getuser = "";
														//		$getemail = "";
														//	}
														//	else
														//		$errormsg = "Nu s-a putut trimite emailul!";
															
														}
															else
														{
														$e = oci_error($query); 
														echo htmlentities($e['message']);
								
														}	
													
												
												
											}
										}
										else
										{
										$e = oci_error($query); 
										echo htmlentities($e['message']);
										}	
										
									}
								}
								else
								{
								$e = oci_error($query); 
								echo htmlentities($e['message']);
								}	
								oci_close($conn);
								}
								else
									$errormsg="You must enter an interest";
							}
							else 
								$errormsg="You must enter a valid email";
						}
						else
							$errormsg = "Passwords did not match.";
					}
					else
						$errormsg = "You must retype your pass to register.";
				}
				else
					$errormsg = "You must enter your pass that has more than 8 characters.";
				}else 
					$errormsg = "You must enter your pass to register.";
			}
			else
				$errormsg = "You must enter your email to register.";
		
		}
		else
			$errormsg = "You must enter your username to register.";
		
	}
	
	
	$form="
		   <div class='info'>
  <h1>News in Computer Science</h1>
  <span>
    Made with
    <i class='fa fa-heart animated infinite pulse'></i>
    by Alex
    <div class='spoilers'>
        (Much Cool!) 
    </div>
  </span>
</div>
<div class='form aniamted bounceIn'>
  
  <div class='login'>
    <h2>Register</h2>
	<div class='alert'>
      <div class='fa fa-times-circle'></div>
	  <p id=\"id01\"><p> 
      <font color='red'> $errormsg </font>
    </div>
    <form action='./register.php' method='post'>
	  
	  <input placeholder='Username'  type='text' name='user' value='$getuser'>
      <input placeholder='Password' type='password' name='password'>
      <input placeholder='Confirm Password' type='password' name='retypepass'>
      <input placeholder='Email Address' type='text' name='email' value='$getemail'>
      <input placeholder='Interests' type='text' name='interest' value='$getinterest'>
      <input type='submit' name='registerbtn' value='Register' id='butt'>
    </form>
  </div>
  
  <footer>
  <a href='./login.php'>Login</a>
  </footer>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    
    <script src=\"js/index.js\"></script>
	

";
		echo "$form";
		
	?>
</body>

</html>