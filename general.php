<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid=$_SESSION['userid'];
$username=$_SESSION['username'];
$searchfieldd=$_SESSION['generalsearch'];
$limbafieldd=$_SESSION['generallimba'];
$domeniufieldd=$_SESSION['generaldomeniu'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 tRANSITIONAL//EN" "http://www.w3.org/TR/xhtml1/dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/shtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title> General - Member </title>
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
	
	  $query = ociparse($conn,"SELECT * FROM USERS WHERE USERNAME='$username'");
				ociexecute($query);
	
	
	
	while (ocifetch($query)) 
        {     
            $dbapelatapi = ociresult($query, "APELATAPI");
			$dbinteres = ociresult($query, "INTERES");
			
			
			}             
	
	  $query = ociparse($conn,"SELECT * FROM USERS ");
				ociexecute($query);
	
	$totalinterese="";
	while (ocifetch($query)) 
        {     
            
			$dbinteres2 = str_replace(' ', '%20', ociresult($query, "INTERES"));
			$dbinteresvalue = ociresult($query, "INTERES");
			$totalinterese="$totalinterese  <button type=\"button\" class=\"btn\" onclick=vreaualtestiri(\"$dbinteres2\") > $dbinteresvalue </button>";
			
			} 

      

			
					
                
	
	if ($_POST['loginbtn']){
		$_SESSION['generalsearch']=$_POST['searchfi'];
		$searchfieldd=$_SESSION['generalsearch'];
		$_SESSION['generallimba']=$_POST['searchli'];
		$limbafieldd=$_SESSION['generallimba'];
		$_SESSION['generaldomeniu']=$_POST['searchdo'];
		$domeniufieldd=$_SESSION['generaldomeniu'];
		$categorie="GENERAL";
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
        	    <li ><a href=\"engineering.php\">Engineering</a></li>
         	   	<li ><a href=\"so.php\">SO</a></li>
          	  	<li><a href=\"games.php\">Games</a></li>
				<li><a href=\"technologies.php\">Technologies</a></li>
				<li><a href=\"languages.php\">Languages</a></li>
				<li><a href=\"trade.php\">Trade</a></li>
				<li class=\"start selected\"><a href=\"general.php\">User Specific</a></li>
				<li class=\"end\" ><a href=\"pagination.php\">Pagination</a></li>
        	</ul>
	</div>
    </nav>
	

    <div id=\"body\" class=\"width\">

		

		<section id=\"content\">

	    <article>
				
			

			<h2>These are the news that we recommend for you! </h2>
		
            <p>The news based on your filters:</p>	
            
            <div id=\"id01\">Here you can search for anything in any field but you MUST enter a search word </div>
			<div id=\"id02\"> aici</div>
			<br />
			<button onclick=generaterss() > rss </button>
			
          </article>

		
		       </section>
        
        <aside class=\"sidebar\">
	
            <ul>	

              				
                <li>
                	
                    <ul>
                    	<li class=\"text\">
                            
									 <h4>If you are looking for something new try these queries</h4>
									  $totalinterese          
								
				
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
			<div id=\"stat\">
            	<li><h4>Top queries </h4></li>
				$statistica
			</div>
            </ul>
            
          
            
            <div class=\"clear\"></div>
        </div>
        <div class=\"footer-bottom\">
            <p>Proiect realizat de Dumitriu Alexandru </p>
  </div>
    </footer>
</div>
<script>

function generaterss(){
	
	destination=\"./makerssfeedforuser.php?username=$username\";
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
			var wnd = window.open(\"about:blank\", \"\", \"_blank\");
			
			wnd.document.write(xhr.responseText);
			//document.getElementById(\"trialll\").innerHTML =xmll;
        }
    }
}

if($dbapelatapi==0) {
	document.getElementById(\"id01\").innerHTML = \"nu s-a apelat api-ul niciodata \"+ replaceAll(' ','%20','$dbinteres');
	faceva();
}
else{
	
	document.getElementById(\"id01\").innerHTML = \"s-a apelat api-ul deja!\";
	showArt();
	}


//addArticle(\"trial\",\"mult text\",\"gvahbjscus\");
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


url = \"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=\"+ replaceAll(' ','%20','$dbinteres')+\"&site_type=news&site_type=blogs\";
			

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
   
   
    document.getElementById(\"id01\").innerHTML = \"Modificat\";
	showArt();
}


function showArt() {
	
    destination=\"./showarticles.php?username=$username\";
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
            document.getElementById(\"id02\").innerHTML=xhr.responseText;
        }
    }
}
topStiri();
function topStiri() {
	
    destination=\"./topstiri.php\";
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
            document.getElementById(\"stat\").innerHTML=xhr.responseText;
        }
    }
}

function topStiri24() {
	
    destination=\"./topstiri24.php\";
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
            document.getElementById(\"stat\").innerHTML=xhr.responseText;
        }
    }
}

function worst24() {
	
    destination=\"./worst24.php\";
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
            document.getElementById(\"stat\").innerHTML=xhr.responseText;
        }
    }
}

function creste(id ){
	destination=\"./upvote.php?idart=\"+id.substring(1,10)+\"&username=$username\";
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
            document.getElementById(id).innerHTML=xhr.responseText;
        }
    }
	
}

function down(id ){
	destination=\"./downvote.php?idart=\"+id.substring(1,10)+\"&username=$username\";
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
            document.getElementById(id).innerHTML=xhr.responseText;
        }
    }
	
}

function vreaualtestiri(inter){
	document.getElementById(\"id01\").innerHTML=replaceAll(' ','%20',inter);
	 destination=\"./shownewsbyinterest.php?interes=\"+replaceAll(' ','%20',inter);
    var xhr=new XMLHttpRequest();
    xhr.open(\"GET\",destination,true);
    xhr.send();
    xhr.onreadystatechange=function() {
        if(xhr.readyState==4 && xhr.status==200) {
            document.getElementById(\"id02\").innerHTML=xhr.responseText;
        }
    }

	
	
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