<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid=$_SESSION['userid'];
$username=$_SESSION['username'];
$nrpagg=$_SESSION['pagina'];
$nrpagina=$_SESSION['pagina'];
$formatt=$_SESSION['format'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 tRANSITIONAL//EN" "http://www.w3.org/TR/xhtml1/dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/shtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title> Pagination - Member </title>
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
	
	               
	$tabel="aici se va afisa tabelul ";
	
	$marimepagina=5;
	
	$query = ociparse($conn,"SELECT ROUND(COUNT(ID)/$marimepagina,0) AS NR FROM SEARCH_TABLE ");
				ociexecute($query);
	
	
	while (ocifetch($query)) 
        {     
            $dbpaginitotal = ociresult($query, "NR")+1;
			
			}
		
    
	
	
	
	$nrpagina = $_SESSION['pagina'];
	$format = $_POST['format'];
	$_SESSION['format']=$format;
	
	
	if($nrpagina<= $dbpaginitotal+1 and $nrpagina>0) {
	
if($format) 
{
	$tabel="<table>";
		$query = ociparse($conn,"SELECT * FROM
(
SELECT a.*, rownum r__
    FROM
    (
SELECT * FROM SEARCH_TABLE WHERE DOMENIU='$format' ORDER BY TERMENI_CAUTATI , ID  
 ) a WHERE rownum < (($nrpagina * $marimepagina) + 1 )
 )
WHERE r__ >= ((($nrpagina-1) * $marimepagina) + 1) ");
				ociexecute($query);
}
else {
		$tabel="<table>";
		$query = ociparse($conn,"SELECT * FROM
(
SELECT a.*, rownum r__
    FROM
    (
SELECT * FROM SEARCH_TABLE  ORDER BY TERMENI_CAUTATI , ID  
 ) a WHERE rownum < (($nrpagina * $marimepagina) + 1 )
 )
WHERE r__ >= ((($nrpagina-1) * $marimepagina) + 1) ");
				ociexecute($query);
}	
	
		$_SESSION['pagina']=$nrpagina;
	while (ocifetch($query)) 
        {   $dbr =  ociresult($query, "R__");
            $dbterm_caut = ociresult($query, "TERMENI_CAUTATI");
			$dbcat =  ociresult($query, "CATEGORIE");
			$dbformat =  ociresult($query, "DOMENIU");
			$dbdata =  ociresult($query, "DATA_CAUTARE");
			$dblimba =  ociresult($query, "LIMBA");
			$dbplatforma =  ociresult($query, "PLATFORMA");
			$tabel="$tabel <tr><td>$dbr</td> <td>$dbterm_caut</td>  <td>$dbcat</td>  <td>$dbformat</td> <td>$dbdata</td> <td>$dblimba</td> <td>$dbplatforma</td></tr>";
			}
		$tabel="$tabel </table>";
		
	}
		
		else $tabel="nu exista aceasta pagina";
	
	
	
	
	

	



if( $_POST['prevbtn']){
	$nrpagina = $_SESSION['pagina'];
	$format = $_POST['format'];
	$_SESSION['format']=$format;

	$nrpagina=$nrpagina-1;
	
	if($nrpagina<= $dbpaginitotal+1 and $nrpagina>0) {
	
if($format) 
{
	$tabel="<table>";
		$query = ociparse($conn,"SELECT * FROM
(
SELECT a.*, rownum r__
    FROM
    (
SELECT * FROM SEARCH_TABLE WHERE DOMENIU='$format' ORDER BY TERMENI_CAUTATI , ID  
 ) a WHERE rownum < (($nrpagina * $marimepagina) + 1 )
 )
WHERE r__ >= ((($nrpagina-1) * $marimepagina) + 1) ");
				ociexecute($query);
}
else {
		$tabel="<table>";
		$query = ociparse($conn,"SELECT * FROM
(
SELECT a.*, rownum r__
    FROM
    (
SELECT * FROM SEARCH_TABLE  ORDER BY TERMENI_CAUTATI , ID  
 ) a WHERE rownum < (($nrpagina * $marimepagina) + 1 )
 )
WHERE r__ >= ((($nrpagina-1) * $marimepagina) + 1) ");
				ociexecute($query);
}	
	
		$_SESSION['pagina']=$nrpagina;
	while (ocifetch($query)) 
        {   $dbr =  ociresult($query, "R__");
            $dbterm_caut = ociresult($query, "TERMENI_CAUTATI");
			$dbcat =  ociresult($query, "CATEGORIE");
			$dbformat =  ociresult($query, "DOMENIU");
			$dbdata =  ociresult($query, "DATA_CAUTARE");
			$dblimba =  ociresult($query, "LIMBA");
			$dbplatforma =  ociresult($query, "PLATFORMA");
			$tabel="$tabel <tr><td>$dbr</td> <td>$dbterm_caut</td>  <td>$dbcat</td>  <td>$dbformat</td> <td>$dbdata</td> <td>$dblimba</td> <td>$dbplatforma</td></tr>";
			}
		$tabel="$tabel </table>";
		
	}
		
		else $tabel="nu exista aceasta pagina";
}


if( $_POST['nextbtn']){
	$nrpagina = $_SESSION['pagina'];
	$format = $_POST['format'];
	$_SESSION['format']=$format;
	$nrpagina=$nrpagina+1;
	
	if($nrpagina<= $dbpaginitotal+1 and $nrpagina>0) {
	
if($format) 
{
	$tabel="<table>";
		$query = ociparse($conn,"SELECT * FROM
(
SELECT a.*, rownum r__
    FROM
    (
SELECT * FROM SEARCH_TABLE WHERE DOMENIU='$format' ORDER BY TERMENI_CAUTATI , ID  
 ) a WHERE rownum < (($nrpagina * $marimepagina) + 1 )
 )
WHERE r__ >= ((($nrpagina-1) * $marimepagina) + 1) ");
				ociexecute($query);
}
else {
		$tabel="<table>";
		$query = ociparse($conn,"SELECT * FROM
(
SELECT a.*, rownum r__
    FROM
    (
SELECT * FROM SEARCH_TABLE  ORDER BY TERMENI_CAUTATI , ID  
 ) a WHERE rownum < (($nrpagina * $marimepagina) + 1 )
 )
WHERE r__ >= ((($nrpagina-1) * $marimepagina) + 1) ");
				ociexecute($query);
}	
	
		$_SESSION['pagina']=$nrpagina;
	while (ocifetch($query)) 
        {   $dbr =  ociresult($query, "R__");
            $dbterm_caut = ociresult($query, "TERMENI_CAUTATI");
			$dbcat =  ociresult($query, "CATEGORIE");
			$dbformat =  ociresult($query, "DOMENIU");
			$dbdata =  ociresult($query, "DATA_CAUTARE");
			$dblimba =  ociresult($query, "LIMBA");
			$dbplatforma =  ociresult($query, "PLATFORMA");
			$tabel="$tabel <tr><td>$dbr</td> <td>$dbterm_caut</td>  <td>$dbcat</td>  <td>$dbformat</td> <td>$dbdata</td> <td>$dblimba</td> <td>$dbplatforma</td></tr>";
			}
		$tabel="$tabel </table>";
		
	}
		
		else $tabel="nu exista aceasta pagina";
}
	
	
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
         	   	<li><a href=\"so.php\">SO</a></li>
          	  	<li><a href=\"games.php\">Games</a></li>
				<li><a href=\"technologies.php\">Technologies</a></li>
				<li><a href=\"languages.php\">Languages</a></li>
				<li><a href=\"trade.php\">Trade</a></li>
				<li><a href=\"general.php\">User Specific</a></li>
				<li class=\"start selected\" ><a href=\"pagination.php\">Pagination</a></li>
        	</ul>
	</div>
    </nav>


    <div id=\"body\" class=\"width\">

		

		<section id=\"content\">

	    <article>
				
			
			<h2>The list of searched words </h2>
			
           <div id=\"id02\"> Trial! </div>
            
            <div id=\"id01\">$tabel</div>


          </article>

		
		       </section>
        
        <aside class=\"sidebar\">
	
            <ul>	
               
                <li>
                	<h4>Numarul paginii</h4>
                    <ul>
                    	<li class=\"text\">
                            <form action='./pagination.php' method='post'>
									<input placeholder='domeniu'  type='text' value='$format' name='format' >
									<input placeholder='pagina'  type='text' value=$nrpagina name='user' >
      
                                   <br />
									<input type='submit' name='prevbtn' value='Prev' id='buttprev'>
									<input type='submit' name='nextbtn' value='Next' id='buttnext'>
                               
                            </form>	
							<p>Total pagini:$dbpaginitotal </p>
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
<script>

parseazalink();	
	function parseazalink() {
	document.getElementById(\"id02\").innerHTML=\"blah\";
    destination=\"http://www.youtube.com\";
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
		echo "<center>Welcome <b>$username </b> .... <a href='./logout.php'> Logout </a><br \> </center>$site";
	}
	else
		echo "Please login to access this page. <a href='./login.php'>Login!</a>";
	
	?>


</body>

</html>