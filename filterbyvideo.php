<?php
error_reporting(E_ALL ^ E_NOTICE);
$sitee=$_GET["site"];

$jsonData = file_get_contents($sitee);
if (strpos($jsonData,'</video>') !== false || strpos($jsonData,'<video') !== false || strpos($jsonData,'video/ogg') !== false || strpos($jsonData,'video/mp4') !== false  ) {
    echo "true";
}
else echo "false";


?>