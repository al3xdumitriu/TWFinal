<?php
error_reporting(E_ALL ^ E_NOTICE);
$sitee=$_GET["site"];


$jsonData = file_get_contents($sitee);
if (strpos($jsonData,'>http') !== false ) {
	$pozinceput=strpos($jsonData,'>http')+1;
}

if (strpos($jsonData,'</a>') !== false ) {
	$pozfinal=strpos($jsonData,'</a>');
}
$lungime=$pozfinal-$pozinceput;
echo substr($jsonData,$pozinceput,$lungime);


?>