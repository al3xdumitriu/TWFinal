<?php
error_reporting(E_ALL ^ E_NOTICE);
$dbid=$_GET["idart"];
$user=$_GET["username"];


$conn=oci_connect("Alex","Johnc3naa","localhost/xe");
$dbvot=4;

$query = ociparse($conn,"SELECT * FROM EVIDENTAVOTURI WHERE IDART=$dbid AND USERNAME='$user'");
				ociexecute($query);
	
	
	while (ocifetch($query)) 
        {    
			
            $dbvot = ociresult($query, "VOTAT");
			
			}


 $query = ociparse($conn,"SELECT * FROM ARTICLES WHERE IDART=$dbid ");
				ociexecute($query);
	
	
	while (ocifetch($query)) 
        {     
            $dbtitlu = ociresult($query, "TITLE");
			$dburl = ociresult($query, "URL");
			$dbpop = ociresult($query, "POPULARITATE");
			
			
			}
	if($dbvot==4){
		$query = ociparse($conn,"INSERT INTO EVIDENTAVOTURI  VALUES('$user',$dbid,0)");
				ociexecute($query);
				$query = ociparse($conn,"UPDATE ARTICLES SET POPULARITATE=POPULARITATE-1 WHERE URL='$dburl' ");
				ociexecute($query);
	$dbpop=$dbpop-1;
	echo "$dbpop";
	}else  if($dbvot==0) {
		echo "$dbpop";
	}else if($dbvot==1){
		$query = ociparse($conn,"UPDATE EVIDENTAVOTURI SET VOTAT=0 WHERE IDART=$dbid AND USERNAME='$user' ");
				ociexecute($query);
		 $query = ociparse($conn,"UPDATE ARTICLES SET POPULARITATE=POPULARITATE-1 WHERE URL='$dburl' ");
				ociexecute($query);
	$dbpop=$dbpop-1;
	echo "$dbpop";
	}else if($dbvot==2){
		$query = ociparse($conn,"UPDATE EVIDENTAVOTURI SET VOTAT=1 WHERE IDART=$dbid AND USERNAME='$user' ");
				ociexecute($query);
		 $query = ociparse($conn,"UPDATE ARTICLES SET POPULARITATE=POPULARITATE-1 WHERE URL='$dburl' ");
				ociexecute($query);
	$dbpop=$dbpop-1;
	echo "$dbpop";
	}
 			
oci_commit($conn);
oci_close($conn);


?>