<?php
error_reporting(E_ALL ^ E_NOTICE);
$sitee=$_GET["site"];

$jsonData = file_get_contents($sitee);
if (strpos($jsonData,'<img src') !== false ) {
    echo "true";
}
else echo "false";


?>