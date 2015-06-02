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
	<link rel="stylesheet" href="styles.css" type="text/css" />

	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

</head>
<body>
	<?php
	
	$site="<div id=\"container\">
    <header>
	<div class=\"width\">
    		<h1>News In Computer Science</h1>
       	</div>
    </header>
    <nav>
	<div class=\"width\">
    		<ul>
        		<li ><a href=\"index.html\">Home</a></li>
        	    <li class=\"start selected\"><a href=\"examples.html\">Engineering</a></li>
         	   	<li><a href=\".php\">SO</a></li>
          	  	<li><a href=\"#\">Games</a></li>
				<li><a href=\"#\">Technologies</a></li>
				<li><a href=\"#\">Languages</a></li>
				<li class=\"end\"><a href=\"#\">Trade</a></li>
        	</ul>
	</div>
    </nav>


    <div id=\"body\" class=\"width\">

		

		<section id=\"content\">

	    <article>
				
			
			<h2>Introduction to pied </h2>
			<div class=\"article-info\">Posted on <time datetime=\"2013-05-14\">14 May</time> by <a href=\"#\" rel=\"author\">Joe Bloggs</a></div>

            <p>Welcome to pied, a free valid CSS3 &amp; HTML5 piednsive web template from <a href=\"http://zypopwebtemplates.com/\" title=\"ZyPOP\">ZyPOP</a>. This template is completely <strong>free</strong> to use permitting a link remains back to  <a href=\"http://zypopwebtemplates.com/\" title=\"ZyPOP\">http://zypopwebtemplates.com/</a>. Should you wish to use this template unbranded you can buy a template license from our website for 8.00 GBP, this will allow you remove all branding related to our site, for more information about this see below.</p>	
            
            <div id=\"id01\">This template has been tested in:</div>


          </article>

		
		       </section>
        
        <aside class=\"sidebar\">
	
            <ul>	
               <li>
                    <h4>Limba</h4>
                    <ul>
                       <li class=\"text\">
                            <form  class=\"searchform\"  >
                                <p>
                                    <input type=\"text\" size=\"31\" value=\"\" name=\"s\" id=\"searchFieldLimba\"  class=\"s\" />
                                    
                                </p>
                            </form>	
						</li>
                    </ul>
                </li>
                
                <li>
                    <h4>Platforma</h4>
                    <ul>
                        <li class=\"text\">
                            <form  class=\"searchform\"  >
                                <p>
                                    <input type=\"text\" size=\"31\" value=\"\" name=\"s\" id=\"searchFieldPlatforma\"  class=\"s\" />
                                    
                                </p>
                            </form>	
						</li>
                    </ul>
                </li>
                
				 <li>
                    <h4>Format</h4>
                    <ul>
                                                    <form  class=\"searchform\"  >
                                <p>
                                    <input type=\"text\" size=\"31\" value=\"\" name=\"s\" id=\"searchFieldPlatforma\"  class=\"s\" />
                                    
                                </p>
                            </form>	
                        
                    </ul>
                </li>
				
                <li>
                	<h4>Cuvinte Cheie</h4>
                    <ul>
                    	<li class=\"text\">
                            <form  class=\"searchform\"  >
                                <p>
                                    <input type=\"text\" size=\"31\" value=\"\" name=\"s\" id=\"searchField1\"  class=\"s\" />
                                    
                                </p>
                            </form>	
							<button type=\"button\" class=\"btn\" onclick=faceva() > Search </button>
							<button type=\"button\" class=\"btn\" onclick=incearcaConectare() > Please </button>
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
            	<li><h4>Condimentum</h4></li>
                <li><a href=\"#\">Curabitur sit amet tellus</a></li>
                <li><a href=\"#\">Morbi hendrerit libero </a></li>
                <li><a href=\"#\">Proin placerat accumsan</a></li>
                <li><a href=\"#\">Rutrum nulla a ultrices</a></li>
                <li><a href=\"#\">Cras dictum</a></li>
            </ul>
            
            <ul class=\"endfooter\">
            	<li><h4>Suspendisse</h4></li>
                <li><a href=\"#\">Morbi hendrerit libero </a></li>
                <li><a href=\"#\">Proin placerat accumsan</a></li>
                <li><a href=\"#\">Rutrum nulla a ultrices</a></li>
                <li><a href=\"#\">Curabitur sit amet tellus</a></li>
                <li><a href=\"#\">Donec in ligula nisl.</a></li>
            </ul>
            
            <div class=\"clear\"></div>
        </div>
        <div class=\"footer-bottom\">
            <p>&copy; YourSite 2014. <a href=\"http://zypopwebtemplates.com/\">Free CSS Website Templates</a> by ZyPOP</p>
         </div>
    </footer>
</div>
<script>

function incearcaConectare(){
document.getElementById(\"id01\").innerHTML = \"Primul pas\";	

			

}

function faceva(){
var xmlhttp = new XMLHttpRequest();
var searchText;
var url ;
searchText=document.getElementById('searchField1').value;
	if(document.getElementById('searchField1').value.length>0) {
		
		
		url = \"./myTutorials.txt\"; //\"https://webhose.io/search?token=67601ceb-c869-4f4c-9c75-cb2289765953&format=json&q=\"+replaceAll(' ','%20',document.getElementById('searchField1').value);
	}
		else{
			url = \"./myTutorials.txt\";
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
    var out ;
	out=\"Rezultate totale gasite:\"+arr.totalResults+\"<br />\";
	
	if(document.getElementById('searchFieldLimba').value.length>0) limba=document.getElementById('searchFieldLimba').value.toLowerCase();
	
	
	if(document.getElementById('searchField1').value.length>0) {
		out+=replaceAll(' ','%20',document.getElementById('searchField1').value);
		
	}
		else{
			out+=\"nu cauti\";
		} 
	
    if(document.getElementById('searchFieldLimba').value.length>0) out+=limba;
	
	for(i = 0; i < arr.posts.length; i++) {
        if(document.getElementById('searchFieldLimba').value.length>0) {
			if(limba==arr.posts[i].language){
		out += \"<br/><h1>\" +arr.posts[i].thread.title+\"</h1><br/>\"+arr.posts[i].text.substring(1,500)+
			\"... <br \>\"+\"<a href='\"+arr.posts[i].url+\"' class='button'>READ MORE</a>\";
			}
		}
		else{
			
			
			
			
			
			
			out += \"<br/><h1>\" +arr.posts[i].thread.title+\"</h1><br/>\"+arr.posts[i].text.substring(1,500)+
		\"... <br \>\"+\"<a href='\"+arr.posts[i].url+\"' class='button'>READ MORE</a>\";
		}
        
    }
   
    document.getElementById(\"id01\").innerHTML = out;
}
</script>
";
	
	if($userid && $username){
		echo "Welcome <b>$username </b> .... <a href='./logout.php'> Logout </a><br \> $site";
	}
	else
		echo "Please login to access this page. <a href='./login.php'>Login!</a>";
	
	?>


</body>

</html>