<?php
error_reporting(E_ALL ^ E_NOTICE);
$user=$_GET["username"];


$conn=oci_connect("Alex","Johnc3naa","localhost/xe");


$s = oci_parse($conn, "UPDATE USERS SET APELATAPI=1 WHERE USERNAME='$user'");
  
ociexecute($s);
oci_commit($conn);
oci_close($conn);


?>