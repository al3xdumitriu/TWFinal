<?php
error_reporting(E_ALL ^ E_NOTICE);
$user=$_GET["username"];
$title=$_GET["title"];
$subtext=$_GET["subtext"];
$url=$_GET["url"];

if(strlen($user)>1 && strlen($title)>1&&strlen($subtext)>1&&strlen($url)>1){

$conn=oci_connect("Alex","Johnc3naa","localhost/xe");


$s = oci_parse($conn, "begin bagaarticol(:bind1,:bind2,:bind3,:bind4,0); end;");
   oci_bind_by_name($s, ":bind1", $user);
   oci_bind_by_name($s, ":bind2", $title);
   oci_bind_by_name($s, ":bind3", $subtext);
   oci_bind_by_name($s, ":bind4", $url);
if(!ociexecute($s)){
														$e = oci_error($query); 
														echo htmlentities($e['message']);
								
														}
oci_commit($conn);
oci_close($conn);
}


?>