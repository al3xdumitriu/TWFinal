<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid=$_SESSION['userid'];
$username=$_SESSION['username'];
$searchfieldd=$_SESSION['gamessearch'];
$limbafieldd=$_SESSION['gameslimba'];
$domeniufieldd=$_SESSION['gamesdomeniu'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 tRANSITIONAL//EN" "http://www.w3.org/TR/xhtml1/dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/shtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title> Games - Member </title>
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
	
	               
			
                
	
	if ($_POST['loginbtn']){
		$_SESSION['gamessearch']=$_POST['searchfi'];
		$searchfieldd=$_SESSION['gamessearch'];
		$_SESSION['gameslimba']=$_POST['searchli'];
		$limbafieldd=$_SESSION['gameslimba'];
		$_SESSION['gamesdomeniu']=$_POST['searchdo'];
		$domeniufieldd=$_SESSION['gamesdomeniu'];
		$categorie="GAMES";
		$dbplatforma2="";
		if($searchfieldd!=""){
		$query = ociparse($conn,"SELECT PLATFORMA FROM DETALIIUTILIZATOR WHERE USERNAME='$username'");
				ociexecute($query);              
	
        while (ocifetch($query)) 
        {     
           
			$dbplatforma2= ociresult($query, "PLATFORMA");

			
			}
		
		$query2 = ociparse($conn,"INSERT INTO SEARCH_TABLE VALUES( '$userid','$searchfieldd','$categorie','$domeniufieldd',sysdate,'$limbafieldd','$dbplatforma2')");
						if(	ociexecute($query2)){
							 
							oci_commit($conn);
						}
						else  {
							$e = oci_error($query2); 
							echo htmlentities($e['message']);
							}
		}
	}
	oci_close($conn);
	$site="
	
	

	
	<div id=\"container\">
    <header>
	<div class=\"width\">
    		<center><img src=\"TEXT.png\" alt=\"Mountain View\" style=\"width:900px;height:100px;\"></center>
       	</div>
    </header>
    <nav>
	<div class=\"width\">
    		<ul>
        		<li ><a href=\"home.php\">Home</a></li>
        	    <li ><a href=\"engineering.php\">Engineering</a></li>
         	   	<li ><a href=\"so.php\">SO</a></li>
          	  	<li class=\"start selected\"><a href=\"games.php\">Games</a></li>
				<li><a href=\"technologies.php\">Technologies</a></li>
				<li><a href=\"languages.php\">Languages</a></li>
				<li><a href=\"trade.php\">Trade</a></li>
				<li><a href=\"general.php\">User Specific</a></li>
				<li class=\"end\" ><a href=\"pagination.php\">Pagination</a></li>
        	</ul>
	</div>
    </nav>


    <div id=\"body\" class=\"width\">

		

		<section id=\"content\">

	    <article>
				
			

			<h2>Welcome to the games news section! </h2>
			<div class=\"fb-share-button\" data-href=\"http://localhost/sgbd/home.php\" data-layout=\"button\" ></div>
            <p>The news based on your filters:</p>	
            
            <div id=\"id01\"></div>


          </article>

		
		       </section>
        
        <aside class=\"sidebar\">
	
            <ul>	

              				
                <li>
                	
                    <ul>
                    	<li class=\"text\">
                            <form action='./games.php' class=\"searchform\" method='post' >
                                <p>
									 <h4>Domeniu</h4>
									<input type=\"text\" size=\"25\" value=\"$domeniufieldd\" name=\"searchdo\" id=\"searchFieldDomeniu\"  class=\"s\" />
									 <h4>Limba</h4>
									<input type=\"text\" size=\"25\" value=\"$limbafieldd\" name=\"searchli\" id=\"searchFieldLimba\"  class=\"s\" />
									<h4>Cuvinte Cheie</h4>
                                    <input type=\"text\" size=\"25\" value=\"$searchfieldd\" name=\"searchfi\" id=\"searchField1\"  class=\"s\" />
                                    <input type='submit' name='loginbtn' value='Search' id='butt' class=\"btn\">
                                </p>
                            </form>	
				
						</li>
					</ul>
                </li>
                
               
                
            </ul>
		
		
		
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
    </footer>
</div>
<div id=\"fb-root\"></div>
<script>

faceva();

function incearcaConectare(){
document.getElementById(\"id01\").innerHTML = \"Primul pas\";	

			

}

function faceva(){
var xmlhttp = new XMLHttpRequest();
var searchText;
var url ;
searchText=document.getElementById('searchField1').value;

	

	if(document.getElementById('searchField1').value.length>0) {
		if(document.getElementById('searchFieldLimba').value.length>0) {
			if(document.getElementById('searchFieldDomeniu').value.length>0){
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20game%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value)+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value)+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
				
			}else{
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20game%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value)+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value);
			}
		}
		else{
			
		if(document.getElementById('searchFieldDomeniu').value.length>0){
		url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20game%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value)+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
		}
		else {
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20game%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value);
			}
		}
	}
		else{
			
			
			if(document.getElementById('searchFieldLimba').value.length>0) {
				
				if(document.getElementById('searchFieldDomeniu').value.length>0){
					url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20game\"+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value)+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
				}
				else{
					url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20game\"+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value);
				}
		}
		else{
			if(document.getElementById('searchFieldDomeniu').value.length>0){
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20game\"+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
			}else{
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20game\"
			;
			}
		}
		} 



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
	
	
	
	//if(document.getElementById('searchField1').value.length>0) {
	//	out+=replaceAll(' ','%20',document.getElementById('searchField1').value);
		
	//}
	
	
    //if(document.getElementById('searchFieldLimba').value.length>0) out+=limba;
	
	for(i = 0; i < arr.posts.length; i++) {
       
			
		out += \"<br/><h1>\" +arr.posts[i].thread.title+\"</h1><br/>\"+arr.posts[i].text.substring(1,500)+
			\"... <br \>\"+\"<a href='\"+arr.posts[i].url+\"' target='_blank' class='button'>READ MORE</a>\"+'<div class=\"fb-share-button\" data-href=\"'+arr.posts[i].url+'\" data-layout=\"button\" ></div>';
			
		
        
    }
   
    document.getElementById(\"id01\").innerHTML = out;
	
	(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = \"//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3\";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
	
}



</script>
";
	
	
	
	
	if($userid && $username){
		echo "<center>Welcome <b>$username </b> .... <a href='./logout.php'> Logout </a><br \></center> $site";
	}
	else
		echo "Please login to access this page. <a href='./login.php'>Login!</a>";
	
	?>


</body>

</html>