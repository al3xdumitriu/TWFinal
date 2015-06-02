<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid=$_SESSION['userid'];
$username=$_SESSION['username'];
$searchfieldd=$_SESSION['engineeringsearch'];
$limbafieldd=$_SESSION['engineeringlimba'];
$domeniufieldd=$_SESSION['engineeringdomeniu'];
$domeniufieldd=$_SESSION['engineeringformat'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 tRANSITIONAL//EN" "http://www.w3.org/TR/xhtml1/dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/shtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title> Engineering - Member </title>
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
		$_SESSION['engineeringsearch']=$_POST['searchfi'];
		$searchfieldd=$_SESSION['engineeringsearch'];
		$_SESSION['engineeringlimba']=$_POST['searchli'];
		$limbafieldd=$_SESSION['engineeringlimba'];
		$_SESSION['engineeringdomeniu']=$_POST['searchdo'];
		$domeniufieldd=$_SESSION['engineeringdomeniu'];
	    $_SESSION['engineeringformat']=$_POST['searchfo'];
		$formatfieldd=$_SESSION['engineeringformat'];
		$categorie="ENGINEERING";
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
	$site="<div id=\"container\">
    <header>
	<div class=\"width\">
    		<center><img src=\"TEXT.png\" alt=\"Mountain View\" style=\"width:900px;height:100px;\"></center>
       	</div>
    </header>
    <nav>
	<div class=\"width\">
    		<ul>
        		<li ><a href=\"home.php\">Home</a></li>
        	    <li class=\"start selected\"><a href=\"engineering.php\">Engineering</a></li>
         	   	<li ><a href=\"so.php\">SO</a></li>
          	  	<li><a href=\"games.php\">Games</a></li>
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
				
			

			<h2>Welcome to the engineering news section! </h2>
			
            <p>The news based on your filters:</p>	
            
            <div id=\"id01\"></div>


          </article>

		
		       </section>
        
        <aside class=\"sidebar\">
	
            <ul>	

              				
                <li>
                	
                    <ul>
                    	<li class=\"text\">
                            <form action='./engineering.php' class=\"searchform\" method='post' >
                                <p>
								     <h4>Format
									 (video,audio,source,imagine,text)</h4>
									<input type=\"text\" size=\"25\" value=\"$formatfieldd\" name=\"searchfo\" id=\"searchFieldFormat\"  class=\"s\" />
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
            <p>&copy; YourSite 2014. <a href=\"http://zypopwebtemplates.com/\">Free CSS Website Templates</a> by ZyPOP</p>
         </div>
    </footer>
</div>
<script>

if (document.getElementById('searchFieldFormat').value<1)
{
	faceva();
}else{
	faceva222();
}

function incearcaConectare(){
document.getElementById(\"id01\").innerHTML = \"Primul pas\";	

			

}

//redirecttt(\"http://omgili.com/r/j.JM_ertN3LQMIn3mdI5_7P7TAF2rcipD.l33WyHbq2gP9h4fy5iH5Jj_POHRX2smpjSKM.ots9vTkzGgnzwGg--\");
//redirecttt(\"http://omgili.com/r/j.JM_ertN3LQMIn3mdI5_7P7TAF2rcipD.l33WyHbq2gP9h4fy5iH5Jj_POHRX2smpjSKM.ots9vTkzGgnzwGg--\");

function redirecttt(sitt,titlu,text) {
	
    destination=\"./filterredirect.php?site=\"+sitt;
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
			//var newElement = document.createElement('div');
			//newElement.innerHTML =xhr.responseText;
            //document.getElementById(\"id01\").appendChild(newElement);
			if(document.getElementById('searchFieldFormat').value==\"video\"){
			parseazavideo(xhr.responseText,titlu,text,sitt);
			}else 
			{if(document.getElementById('searchFieldFormat').value==\"audio\"){
			parseazaaudio(xhr.responseText,titlu,text,sitt);
			}
			else{
				if(document.getElementById('searchFieldFormat').value==\"source\"){
			parseazasource(xhr.responseText,titlu,text,sitt);
			}else{
				if(document.getElementById('searchFieldFormat').value==\"imagine\"){
			parseazaimagini(xhr.responseText,titlu,text,sitt);
			}else{
				if(document.getElementById('searchFieldFormat').value==\"text\"){
			parseazatext(xhr.responseText,titlu,text,sitt);
			}
			}
				
			}

			}
		}
    }
}
}

function parseazavideo(sitt,titlu,text,url) {
	
    destination=\"./filterbyvideo.php?site=\"+sitt;
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
			var newElement = document.createElement('div');
			if(xhr.responseText==\"true\") newElement.innerHTML = \"<br/><h1>\" +titlu+\"</h1><br/>\"+text+\"... <br \>\"+\"<a href='\"+url+\"' target='_blank' class='button'>READ MORE</a>\";
			else newElement.innerHTML =\" \";
			document.getElementById(\"id01\").appendChild(newElement);
        }
    }
	
	
		
	
}

function parseazaaudio(sitt,titlu,text,url) {
	
    destination=\"./filterbyaudio.php?site=\"+sitt;
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
			var newElement = document.createElement('div');
			if(xhr.responseText==\"true\") newElement.innerHTML = \"<br/><h1>\" +titlu+\"</h1><br/>\"+text+\"... <br \>\"+\"<a href='\"+url+\"' target='_blank' class='button'>READ MORE</a>\";
			else newElement.innerHTML =\" \";
			document.getElementById(\"id01\").appendChild(newElement);
        }
    }
	
	
		
	
}


function parseazaimagini(sitt,titlu,text,url) {
	
    destination=\"./filterbyimagini.php?site=\"+sitt;
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
			var newElement = document.createElement('div');
			if(xhr.responseText==\"true\") newElement.innerHTML = \"<br/><h1>\" +titlu+\"</h1><br/>\"+text+\"... <br \>\"+\"<a href='\"+url+\"' target='_blank' class='button'>READ MORE</a>\";
			else newElement.innerHTML =\" \";
			document.getElementById(\"id01\").appendChild(newElement);
        }
    }
	
	
		
	
}


function parseazasource(sitt,titlu,text,url) {
	
    destination=\"./filterbysource.php?site=\"+sitt;
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
			var newElement = document.createElement('div');
			if(xhr.responseText==\"true\") newElement.innerHTML = \"<br/><h1>\" +titlu+\"</h1><br/>\"+text+\"... <br \>\"+\"<a href='\"+url+\"' target='_blank' class='button'>READ MORE</a>\";
			else newElement.innerHTML =\" \";
			document.getElementById(\"id01\").appendChild(newElement);
        }
    }
	
	
		
	
}

function parseazatext(sitt,titlu,text,url) {
	
    
			var newElement = document.createElement('div');
			newElement.innerHTML = \"<br/><h1>\" +titlu+\"</h1><br/>\"+text+\"... <br \>\"+\"<a href='\"+url+\"' target='_blank' class='button'>READ MORE</a>\";
			
			document.getElementById(\"id01\").appendChild(newElement);
    
	
	
		
	
}


function faceva(){
var xmlhttp = new XMLHttpRequest();
var searchText;
var url ;
searchText=document.getElementById('searchField1').value;

	

	if(document.getElementById('searchField1').value.length>0) {
		if(document.getElementById('searchFieldLimba').value.length>0) {
			if(document.getElementById('searchFieldDomeniu').value.length>0){
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20engineer%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value)+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value)+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
				
			}else{
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20engineer%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value)+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value);
			}
		}
		else{
			
		if(document.getElementById('searchFieldDomeniu').value.length>0){
		url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20engineer%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value)+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
		}
		else {
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20engineer%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value);
			}
		}
	}
		else{
			
			
			if(document.getElementById('searchFieldLimba').value.length>0) {
				
				if(document.getElementById('searchFieldDomeniu').value.length>0){
					url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20engineer\"+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value)+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
				}
				else{
					url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20engineer\"+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value);
				}
		}
		else{
			if(document.getElementById('searchFieldDomeniu').value.length>0){
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20engineer\"+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
			}else{
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=IT%20engineer\";
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
			\"... <br \>\"+\"<a href='\"+arr.posts[i].url+\"' target='_blank' class='button'>READ MORE</a>\";
			
		
        
    }
   
    document.getElementById(\"id01\").innerHTML = out;
}


function faceva222(){
var xmlhttp = new XMLHttpRequest();
var searchText;
var url ;
searchText=document.getElementById('searchField1').value;

	

	if(document.getElementById('searchField1').value.length>0) {
		if(document.getElementById('searchFieldLimba').value.length>0) {
			if(document.getElementById('searchFieldDomeniu').value.length>0){
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=operating%20system%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value)+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value)+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
				
			}else{
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=operating%20system%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value)+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value);
			}
		}
		else{
			
		if(document.getElementById('searchFieldDomeniu').value.length>0){
		url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=operating%20system%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value)+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
		}
		else {
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=operating%20system%20\"+replaceAll(' ','%20',document.getElementById('searchField1').value);
			}
		}
	}
		else{
			
			
			if(document.getElementById('searchFieldLimba').value.length>0) {
				
				if(document.getElementById('searchFieldDomeniu').value.length>0){
					url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=operating%20system\"+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value)+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
				}
				else{
					url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=operating%20system\"+\"&language=\"+replaceAll(' ','%20',document.getElementById('searchFieldLimba').value);
				}
		}
		else{
			if(document.getElementById('searchFieldDomeniu').value.length>0){
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=operating%20system\"+\"&site=\"+document.getElementById('searchFieldDomeniu').value;
			}else{
			url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=operating%20system\";
			}
		}
		} 



xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        myFunction222(xmlhttp.responseText);
    }
}
xmlhttp.open(\"POST\", url, true);
xmlhttp.send();
}



function myFunction222(response) {
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
       
	   redirecttt(arr.posts[i].url,arr.posts[i].thread.title,arr.posts[i].text.substring(0,500));
			
		//out += \"<br/><h1>\" +arr.posts[i].thread.title+\"</h1><br/>\"+arr.posts[i].text.substring(0,500)+
			//\"... <br \>\"+\"<a href='\"+arr.posts[i].url+\"' target='_blank' class='button'>READ MORE</a>\";
		
		
        
    }
   
    document.getElementById(\"id01\").innerHTML = out;
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