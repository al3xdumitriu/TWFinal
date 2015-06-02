<?php
error_reporting(E_ALL ^ E_NOTICE);
$sitee=$_GET["site"];

$jsonData = file_get_contents($sitee);
if (strpos($jsonData,'</audio>') !== false || strpos($jsonData,'<audio') !== false || strpos($jsonData,'audio/ogg') !== false || strpos($jsonData,'audio/mp4') !== false ) {
    echo "true";
}
else echo "false";


?>