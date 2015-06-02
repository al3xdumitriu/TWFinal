<?php
error_reporting(E_ALL ^ E_NOTICE);
$user=$_GET["username"];


$conn=oci_connect("Alex","Johnc3naa","localhost/xe");


 $query = ociparse($conn,"SELECT * FROM ARTICLES WHERE USERNAME='$user'  AND TRUNC(DATA_CURENTA)=(SELECT MAX(TRUNC(DATA_CURENTA)) FROM ARTICLES WHERE USERNAME='$user') ORDER BY POPULARITATE DESC");
				ociexecute($query);
	
	$finalhtml="&lt?xml version=\"1.0\" encoding=\"UTF-8\"?&gt <br />
&ltrss xmlns:dc=\"http://purl.org/dc/elements/1.1/\" version=\"2.0\"&gt <br />
  &ltchannel&gt <br />
	&lttitle&gtNuCS RSS&lt/title&gt <br />
    &ltlink&gtlocalhost://SGBD//home.php&lt/link&gt <br />
	&ltdescription&gt results&lt/description&gt <br />
";
	while (ocifetch($query)) 
        {     
            $dbtitlu = ociresult($query, "TITLE");
			$dbsubtext = ociresult($query, "SUBTEXT");
			$dburl = ociresult($query, "URL");
			$dbpop = ociresult($query, "POPULARITATE");
			$dbid = ociresult($query, "IDART");
			if(strlen($dburl)>1 && strlen($dbtitlu)>1&&strlen($dbsubtext)>1)$finalhtml="$finalhtml &ltitem&gt <br />
			&lttitle&gt$dbtitlu&lt/title&gt <br />
			&ltlink&gt$dburl&lt/link&gt <br />
			&ltdescription&gt$dbsubtext &lt/description&gt <br />
			&lt/item&gt <br />
			";
			}             
			echo "$finalhtml  &lt/channel&gt <br />
&lt/rss&gt  <br />";
			
oci_commit($conn);
oci_close($conn);


?>