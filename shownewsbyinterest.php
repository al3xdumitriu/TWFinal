<?php
error_reporting(E_ALL ^ E_NOTICE);
$inter=$_GET["interes"];


$conn=oci_connect("Alex","Johnc3naa","localhost/xe");

$query = ociparse($conn,"SELECT * FROM USERS WHERE INTERES='$inter' ");
				ociexecute($query);
	while (ocifetch($query)) 
        {     
            $dbuser = ociresult($query, "USERNAME");
			
			}            


 $query = ociparse($conn,"SELECT * FROM ARTICLES WHERE USERNAME='$dbuser' ORDER BY POPULARITATE DESC");
				ociexecute($query);
	
	$finalhtml="";
	while (ocifetch($query)) 
        {     
            $dbtitlu = ociresult($query, "TITLE");
			$dbsubtext = ociresult($query, "SUBTEXT");
			$dburl = ociresult($query, "URL");
			$dbpop = ociresult($query, "POPULARITATE");
			$dbid = ociresult($query, "IDART");
			$finalhtml="$finalhtml <br/><h1>  $dbtitlu </h1><br/> $dbsubtext ... <br \><div><div><button type=\"button\" class=\"btn2\" onclick=creste(\"a$dbid\") > Upvote </button> <div id=\"a$dbid\"> $dbpop</div> <button type=\"button\" class=\"btn2\" onclick=down(\"a$dbid\") > Downvote </button> </div> <a href='$dburl' target='_blank' class='button'>READ MORE</a> </div>";
			}             
			echo "$finalhtml";
			
oci_commit($conn);
oci_close($conn);


?>