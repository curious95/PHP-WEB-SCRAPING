<?php

//Loading the html files dynamically
$html = file_get_contents('http://www.alltidhest.org/Horses/Page/0');

//echo $html;

//Creating a DOM Object
$dom = new domDocument;
@$dom->loadHTML($html);
$dom->preserveWhiteSpace = false;

$tables = $dom->getElementsByTagName('table');



for($i=0;$i<999999;$i++){

	$rows = $tables->item(0)->getElementsByTagName('tr');
	if($rows->length <=1){
		break;
	}


	foreach ($rows as $row) {
	        $cols = $row->getElementsByTagName('td');
	        
	        $myobj = null;

	        // fetching all the required columns
	        $myobj->$horseID = trim($cols[1]->nodeValue);
	        $myobj->$horseName = trim($cols[2]->nodeValue);
	        $myobj->$regNo = trim($cols[3]->nodeValue);
	        $myobj->$age = trim($cols[4]->nodeValue);
	        $myobj->$sex = trim($cols[5]->nodeValue);
	        $myobj->$color = trim($cols[6]->nodeValue);
	        $myobj->$country = trim($cols[7]->nodeValue);

	        echo $myobj->$horseID.'   '.$myobj->$horseName.'   '.$myobj->$regNo.'   '.$myobj->$age.'   '.$myobj->$sex.'   '.$myobj->$color.'   '.$myobj->$country."\n";
	}
}


?>