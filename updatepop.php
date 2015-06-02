<?php
error_reporting(E_ALL ^ E_NOTICE);



$conn=oci_connect("Alex","Johnc3naa","localhost/xe");


$s = oci_parse($conn, "begin updatepop; end;");

if(!ociexecute($s)){
														$e = oci_error($query); 
														echo htmlentities($e['message']);
								                        
														}
oci_commit($conn);
oci_close($conn);


?>