<?php

//Loading the html files dynamically
$html = file_get_contents('http://www.alltidhest.org/Horses/Page/1');

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
	        

	        // fetching all the required columns
	        $horseID = trim($cols[1]->nodeValue);
	        $horseName = trim($cols[2]->nodeValue);
	        $regNo = trim($cols[3]->nodeValue);
	        $age = trim($cols[4]->nodeValue);
	        $sex = trim($cols[5]->nodeValue);
	        $color = trim($cols[6]->nodeValue);
	        $country = trim($cols[7]->nodeValue);

	        echo $horseID.'   '.$horseName.'   '.$regNo.'   '.$age.'   '.$sex.'   '.$color.'   '.$country."\n";
	}
}


?>