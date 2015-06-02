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
	<title> Home - Member </title>
	<link rel="stylesheet" href="styles.css" type="text/css" />

	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

</head>
<body>
	<?php
	$statistica="";
	$conn=oci_connect("Alex","Johnc3naa","localhost/xe");
	$query = ociparse($conn,"SELECT * FROM TOP_5_QUERIES ");
				ociexecute($query);
	
	
	
	while (ocifetch($query)) 
        {     
            $dbterm = ociresult($query, "TERMENI_CAUTATI");
			$vrecventa= ociresult($query, "FRECVENTA");
			
			$statistica="$statistica <li> $dbterm   ($vrecventa times)</li>";
			}
	
	
	 $query = ociparse($conn,"SELECT * FROM DETALIIUTILIZATOR WHERE USERNAME='$username'");
				ociexecute($query);              
	
        while (ocifetch($query)) 
        {     
            $dbnume = ociresult($query, "NUME");
			$dbprenume= ociresult($query, "PRENUME");
			$dbvarsta= ociresult($query, "VARSTA");
			$dbso_folosit= ociresult($query, "SO_FOLOSIT");
			$dbplatforma= ociresult($query, "PLATFORMA");
			$dblimbivorbite= ociresult($query, "LIMBIVORBITE");
			$dbtelefonmobil= ociresult($query, "TELEFONMOBIL");
			$dbfix= ociresult($query, "FIX");
			$dbadresa= ociresult($query, "ADRESA");
			
			}
	$query = ociparse($conn,"SELECT * FROM USERS WHERE USERNAME='$username'");
				ociexecute($query);
	
	$dbapelatapi=0;
	while (ocifetch($query)) 
        {     
            $dbapelatapi = ociresult($query, "APELATAPI");
			$dbinteres = ociresult($query, "INTERES");
			
			
			}
	$dbvechime=4;
	
	
	$query = ociparse($conn,"SELECT COUNT(IDART) AS COUNTT FROM ARTICLES WHERE USERNAME='$username'");
				ociexecute($query);
	
	
	while (ocifetch($query)) 
        {     
            $dbvechimeexista = ociresult($query, "COUNTT");
			
			
			
			}   	
	
	if($dbvechimeexista!=0){
	$query = ociparse($conn,"SELECT TRUNC(SYSDATE)-(SELECT MAX(TRUNC(DATA_CURENTA)) FROM ARTICLES WHERE USERNAME='$username') AS ZILEDEPARTARE FROM ARTICLES WHERE ROWNUM=1");
				ociexecute($query);
	
	
	while (ocifetch($query)) 
        {     
            $dbvechime = ociresult($query, "ZILEDEPARTARE");
			
			
			
			}   	
			
	}          
	oci_close($conn);
	set_time_limit(400);
	
	$site="<div id=\"container\">
    <header>
	<div class=\"width\">
    		<center><img src=\"TEXT.png\" alt=\"Mountain View\" style=\"width:900px;height:100px;\"></center>
       	</div>
    </header>
    <nav>
	<div class=\"width\">
    		<ul>
        		<li class=\"start selected\"><a href=\"home.php\">Home</a></li>
        	    <li ><a href=\"engineering.php\">Engineering</a></li>
         	   	<li><a href=\"so.php\">SO</a></li>
          	  	<li><a href=\"games.php\">Games</a></li>
				<li><a href=\"technologies.php\">Technologies</a></li>
				<li><a href=\"languages.php\">Languages</a></li>
				<li ><a href=\"trade.php\">Trade</a></li>
				<li><a href=\"general.php\">User Specific</a></li>
				<li class=\"end\" ><a href=\"pagination.php\">Pagination</a></li>
        	</ul>
	</div>
    </nav>


    <div id=\"body\" class=\"width\">

		

		<section id=\"content\">

	    <article>
				
			
			<h2>Bine ai venit $username!!!!</h2>
			 <div id=\"id01\">Here you can search for anything in any field but you MUST enter a search word </div>
			<div id=\"id02\">  </div>
		 <form action='./home.php' method='post' class=\"searchform\">
	 <ul> 
	 
	   <li><h4>Nume : <input placeholder='Ex: Dumitriu'  type='text' name='nume' value='$dbnume'></h4></li>
       <li><h4>Prenume : <input placeholder='Ex: Alex' type='text' name='prenume' value='$dbprenume'></h4></li>
       <li><h4>Varsta : <input placeholder='Ex: 18' type='text' name='varsta' value=$dbvarsta></h4></li>
       <li><h4>SO Folosit : <input placeholder='Ex: Windows 8' type='text' name='so' value='$dbso_folosit'></h4></li>
	   <li><h4>Platforma : <input placeholder='Ex: PC' type='text' name='platforma' value='$dbplatforma'></h4></li>
      <li><h4>Limba : <input placeholder='EX: english' type='text' name='limba' value='$dblimbivorbite'></h4></li>
	  <li><h4>Telefon mobil : <input placeholder='Ex: 0740000000' type='text' name='mobil' value='$dbtelefonmobil'></h4></li>
	  <li><h4>Fix : <input placeholder='Ex 0230....' type='text' name='fix' value='$dbfix'></h4></li>
	  <li><h4>Adresa : <input placeholder='Ex: Iasi,Romania' type='text' name='adresa' value='$dbadresa'></h4></li>
	  
	  
     </ul>
	 
	  <input type='submit' name='changebtn' value='Change!' id='butt'>
   
	</form>
		
            


          </article>

		
		       </section>
        
        <aside class=\"sidebar\">
	<h5>Do you want to change your password ?</h5>
            	 <form action='./home.php' method='post' class=\"searchform\">
	 <ul> 
	   <li><h4>Parola veche : <input placeholder='Type old password'  type='password' name='oldpass' ></h4></li>
       <li><h4>Parola noua : <input placeholder='Type new password' type='password' name='newpass'></h4></li>
       <li><h4>Rescrieti parola : <input placeholder='Confirm Password' type='password' name='retypepass'></h4></li>
      
	  
	  
     </ul>
	 
	  <input type='submit' name='changepassbtn' value='Change!' id='changepassbut'>
   
	</form>
	
		<h5> your interests: <div id=\"id04\">\"$dbinteres\"?</div></h5>
		 <form  action=\"\" class=\"searchform2\" onkeypress=\"return event.keyCode != 13;\">
	 <ul> 
	   <li><h4>Interes nou : <input placeholder='Type new interest'  type='text' name='newint' id='newinteres' ></h4></li>
		
	  
	  
     </ul>
	 
	  <input type='button' name='changeintbtn' value='Change!' id='changeinteresbut' onclick='schimbainteres()'>
   
	</form>
		
	<form action='./home.php' method='post' class=\"searchform\">
		Import from csv:
	<input type='submit' name='import' value='Import!' id='importbut'>
	
	</form>
	
	<form action='./home.php' method='post' class=\"searchform\">
		Export to csv:
	<input type='submit' name='export' value='Export!' id='exportbut'>
	
	</form>
        </aside>
    	<div class=\"clear\"></div>
    </div>
    <footer>
	
        <div class=\"footer-content width\">
            <ul>
            	<li><h4>Echipa:</h4></li>
                <li>Dumitriu Alexandru</li>
				<li>Dediu Vlad</li>
                <li>Gaman Andrei</li>
                <li>Stefanescu Cosmin-Andrei</li>
			
            </ul>
            
            <ul>
            	<li><h4>Top queries </h4></li>
				$statistica

            </ul>
            
          
            
            <div class=\"clear\"></div>
        </div>
        <div class=\"footer-bottom\">
            <p>Proiect realizat de Dumitriu Alexandru </p>
         </div>
		 	<script>
	
	function schimbainteres(){
		
		destination=\"./changeinteres.php?username=$username&interests=\"+document.getElementById(\"newinteres\").value;
		var xhr=new XMLHttpRequest();
		xhr.open(\"GET\",destination,true);
		xhr.send();
		xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
            document.getElementById(\"id02\").innerHTML=xhr.responseText;
        }
		document.getElementById(\"id01\").innerHTML = \"Va rugam asteptati pana procesam datele \";
	    document.getElementById(\"id04\").innerHTML = document.getElementById(\"newinteres\").value;
		faceva2(document.getElementById(\"newinteres\").value);
    }
	}

	
	
	if( $dbvechime>2 || $dbapelatapi==0 ) {
	document.getElementById(\"id01\").innerHTML = \"Va rugam asteptati pana procesam datele \";
	faceva();
	}
	else document.getElementById(\"id01\").innerHTML = \"  \";
	


	
	function addArticle(ti,su,ur) {
    destination=\"./insertarticles.php?username=$username&title=\"+ti+\"&subtext=\"+su+\"&url=\"+ur;
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
            document.getElementById(\"id02\").innerHTML=xhr.responseText;
        }
    }
}

function setApelat() {
	
    destination=\"./updateusersapelat.php?username=$username\";
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
            document.getElementById(\"id02\").innerHTML=xhr.responseText;
        }
    }
}



function updat() {
	
    destination=\"./updatepop.php\";
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
            document.getElementById(\"id02\").innerHTML=xhr.responseText;
        }
    }
}




function faceva(){
var xmlhttp = new XMLHttpRequest();
var searchText;
var url ;
document.getElementById(\"id01\").innerHTML = \"Informatiile sunt procesate\";

url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=\"+ replaceAll(' ','%20','$dbinteres')+\"&site_type=news&site_type=blogs\";
			

xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        myFunction(xmlhttp.responseText);
    }
}
xmlhttp.open(\"POST\", url, true);
xmlhttp.send();
}


function faceva2(str){
var xmlhttp = new XMLHttpRequest();
var searchText;
var url ;
document.getElementById(\"id01\").innerHTML = \"Informatiile sunt procesate\";

url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=\"+ replaceAll(' ','%20',str)+\"&site_type=news&site_type=blogs\";
			

xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        myFunction(xmlhttp.responseText);
    }
}
xmlhttp.open(\"POST\", url, true);
xmlhttp.send();
}


function replaceAll(find, replace, str) {
  return str.replace(new RegExp(find, 'g'), replace);
}

function myFunction(response) {
    var arr = JSON.parse(response);
    var i;
	var limba;
    var out=\"\" ;
	//out=\"Rezultate totale gasite:\"+arr.totalResults+\"<br />\";
	
	
	

	for(i = 0; i < arr.posts.length; i++) {
       
			
		//out += \"<br/><h1>\" +arr.posts[i].thread.title+\"</h1><br/>\"+arr.posts[i].text.substring(1,500)+
			//\"... <br \>\"+\"<a href='\"+arr.posts[i].url+\"' class='button'>READ MORE</a>\";
		if(arr.posts[i].thread.title.substring(0,245).length>5 && arr.posts[i].text.substring(0,500).length>20 && arr.posts[i].url.length>10 )
		addArticle(arr.posts[i].thread.title.substring(0,245),arr.posts[i].text.substring(0,500),arr.posts[i].url.substring(0,200));
		for(j = 0; j < 40000000; j++){
			var asdasdasd=\"sadasd\";
		}
        
    }
   setApelat();
   updat();
   
   
    document.getElementById(\"id01\").innerHTML = \"Done!\";
	
}



	
	
	</script>
    </footer>
</div>
";
	if ($_POST['import']){
		
		$conn=oci_connect("Alex","Johnc3naa","localhost/xe");
		$query = ociparse($conn,"BEGIN AFISARE_FIS2; END;");
			if(	ociexecute($query)){
				echo "<center><font color='red'>Imported succesfully</font></center>";
			}
			else {
		$e = oci_error($query); 
        echo htmlentities($e['message']);
		}
	}
	
		if ($_POST['export']){
		
		$conn=oci_connect("Alex","Johnc3naa","localhost/xe");
		$query = ociparse($conn,"BEGIN EXPORT_FIS2; END;");
			if(	ociexecute($query)){
				echo "<center><font color='red'>Exported succesfully</font></center>";
			}
			else {
		$e = oci_error($query); 
        echo htmlentities($e['message']);
		}
	}
	
	if ($_POST['changepassbtn']){
		$oldpassword = $_POST['oldpass'];
		$newpassword = $_POST['newpass'];
		$repassword = $_POST['retypepass'];
		$conn=oci_connect("Alex","Johnc3naa","localhost/xe");
		
		$oldpassword=md5(md5("dh2gfd".$oldpassword."DG43gfd"));
		if (!$conn)
			
			echo "<center><font color='red'>Failed to connect to Oracle</font></center>";
			
			$query = ociparse($conn,"SELECT PASSWORD FROM USERS WHERE USERNAME='$username'");
			if(	ociexecute($query)){
				 while (ocifetch($query)) 
				{ 
				
				if($oldpassword==ociresult($query, "PASSWORD")) {
					if($newpassword==$repassword and $newpassword!=''){
					$newpassword=md5(md5("dh2gfd".$newpassword."DG43gfd"));
					$query2 = ociparse($conn,"UPDATE USERS SET PASSWORD='$newpassword' WHERE USERNAME='$username'");
						if(	ociexecute($query2)){
							 echo "<center><font color='red'>password changed!</font></center>";
			 
						}
						else  {
							$e = oci_error($query2); 
							echo htmlentities($e['message']);
							}
					}
					else echo "<center><font color='red'>passwords do not match or empty!</font></center>";
			 
				}
				else echo "<center><font color='red'>WRONG PASSWORD!</font></center>";
			
				}
		    }
			else  {
		$e = oci_error($query); 
        echo htmlentities($e['message']);
		}
		oci_commit($conn);
		oci_close($conn);
	}
	
	if ($_POST['changebtn']){
		
		
		$conn=oci_connect("Alex","Johnc3naa","localhost/xe");
		$query = ociparse($conn,"SELECT * FROM DETALIIUTILIZATOR WHERE USERNAME='$username'");
				ociexecute($query);              
	
        while (ocifetch($query)) 
        {     
            $dbnume2 = ociresult($query, "NUME");
			$dbprenume2= ociresult($query, "PRENUME");
			$dbvarsta2= ociresult($query, "VARSTA");
			$dbso_folosit2= ociresult($query, "SO_FOLOSIT");
			$dbplatforma2= ociresult($query, "PLATFORMA");
			$dblimbivorbite2= ociresult($query, "LIMBIVORBITE");
			$dbtelefonmobil2= ociresult($query, "TELEFONMOBIL");
			$dbfix2= ociresult($query, "FIX");
			$dbadresa2= ociresult($query, "ADRESA");
			
			}
		
                
	oci_close($conn);
		
		if($dbnume==$dbnume2 and $dbprenume==$dbprenume2 and $dbvarsta==$dbvarsta2 and $dbso_folosit==$dbso_folosit2 and $dbplatforma==$dbplatforma2 and $dblimbivorbite==$dblimbivorbite2 and $dbtelefonmobil==$dbtelefonmobil2 and $dbfix==$dbfix2 and $dbadresa==$dbadresa2){
			
		
		
		
		
		
		
		
		
		$nume = $_POST['nume'];
		$prenume2 = $_POST['prenume'];
		$varsta = $_POST['varsta'];
		$so_folosit = $_POST['so'];
		$platforma = $_POST['platforma'];
		$limba = $_POST['limba'];
		$mobil = $_POST['mobil'];
		$fix = $_POST['fix'];
		$adresa = $_POST['adresa'];
		
		
		$conn=oci_connect("Alex","Johnc3naa","localhost/xe");
		
		if (!$conn)
        	echo "<center><font color='red'>Failed to connect to Oracle</font></center>";
			
			$query = ociparse($conn,"SELECT * FROM DETALIIUTILIZATOR WHERE USERNAME='$username'");
			if(	ociexecute($query)){
				$gasit=0;
				 while (ocifetch($query)) 
				{ 
					$gasit=1;
					$query2 = ociparse($conn,"UPDATE DETALIIUTILIZATOR SET NUME='$nume',PRENUME='$prenume2',VARSTA=$varsta, SO_FOLOSIT='$so_folosit',PLATFORMA='$platforma',LIMBIVORBITE='$limba',TELEFONMOBIL='$mobil',FIX='$fix',ADRESA='$adresa' WHERE USERNAME='$username'");
						if(	ociexecute($query2)){
							 echo "<center><font color='red'>table updated!</font></center>";
			 
						}
						else  {
							$e = oci_error($query2); 
							echo htmlentities($e['message']);
							}
				
				}
				if ($gasit==0){
					
					$query2 = ociparse($conn,"INSERT INTO DETALIIUTILIZATOR VALUES('$username','$nume','$prenume2','$varsta','$so_folosit','$platforma','$limba','$mobil','$fix','$adresa')");
						if(	ociexecute($query2)){
							 echo "<center><font color='red'>row inserted!Please refresh to see changes:)</font></center>";
							oci_commit($conn);
						}
						else  {
							$e = oci_error($query2); 
							echo htmlentities($e['message']);
							}
				}
		    }
			else  {
		$e = oci_error($query); 
        echo htmlentities($e['message']);
		}
		
		oci_close($conn);
		}
		else{
			echo "<center><font color='red'>Baza de date a fost deja modificata!</font></center>";
		}
		
	}
	
	
	
	if($userid && $username){
		
		echo "<center> Welcome <b>$username </b> .... <a href='./logout.php'> Logout </a><br \></center> $site";
	}
	else
		echo "Please login to access this page. <a href='./login.php'>Login!</a>";
	
	
	
	?>
	
	
	
	


</body>

</html>