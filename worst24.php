<?php
error_reporting(E_ALL ^ E_NOTICE);



$conn=oci_connect("Alex","Johnc3naa","localhost/xe");


$query = ociparse($conn,"SELECT *
FROM(SELECT DISTINCT TITLE,URL,POPULARITATE FROM ARTICLES WHERE TRUNC(DATA_CURENTA)=TRUNC(SYSDATE)  ORDER BY POPULARITATE) QUERIES WHERE ROWNUM <= 3
ORDER BY ROWNUM");
				ociexecute($query);
	
	$totaltopstiri="<li><button onclick=topStiri()>Top Stiri </button><button onclick=topStiri24()>Top 24h </button><button onclick=worst24()>Worst 24h </button></li><li><h4>Worst 3 news(24h)<h4></li>";
	while (ocifetch($query)) 
        {     
            
			$dbtopstirititle =  ociresult($query, "TITLE");
			$dbtopstiriurl = ociresult($query, "URL");			
			$dbtopstiripop = ociresult($query, "POPULARITATE");
			$totaltopstiri="$totaltopstiri <li>  <a href='$dbtopstiriurl' target='_blank'> $dbtopstirititle ($dbtopstiripop votes) </a> </li>";
			
			}             
			echo "$totaltopstiri";
			
oci_commit($conn);
oci_close($conn);


?>