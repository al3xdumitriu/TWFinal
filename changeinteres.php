<?php
error_reporting(E_ALL ^ E_NOTICE);
$user=$_GET["username"];
$interesnou=$_GET["interests"];

$conn=oci_connect("Alex","Johnc3naa","localhost/xe");

 $query = ociparse($conn,"UPDATE USERS SET INTERES='$interesnou' WHERE USERNAME='$user'");
				ociexecute($query);


 $query2 = ociparse($conn,"DELETE FROM ARTICLES WHERE USERNAME='$user'");
				ociexecute($query2);
				
	
	
	
			
oci_commit($conn);
oci_close($conn);


?>