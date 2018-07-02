<?php

//error_reporting(0);

// Array to store details of each horse
$myarray = array();
$jsonData = "";
$myobj = new stdClass();

$limit = 8;

//Creating a file to store the json
$myfile = fopen("horseDetails.json", "w") or die("Unable to open file!");


for($i=5;$i<=$limit;$i++){

	//Loading the html files dynamically
	$URL = 'http://www.alltidhest.org/Horses/Page/'.$i;
	$html = file_get_contents($URL);
	//echo $html;
	echo $URL."\n";

	//echo $html;

	//Creating a DOM Object
	$dom = new domDocument;
	@$dom->loadHTML($html);
	$dom->preserveWhiteSpace = false;

	$tables = $dom->getElementsByTagName('table');


	$rows = $tables->item(0)->getElementsByTagName('tr');
	
	// Checking if we reached the end page...if so the scrapper stops and writes all the accumulated data to a json file
	if($rows->length <=1 or $i==$limit){
		//echo json_encode($myarray);
		fwrite($myfile, json_encode($myarray));
		fclose($myfile);
		break;
	}



	foreach ($rows as $row) {
	        $cols = $row->getElementsByTagName('td');
	        
	        //$myobj = null;
	        $myobj = new stdClass();
	        // fetching all the required columns
	        $myobj->horseID = trim($cols[1]->nodeValue);
	        $myobj->horseName = trim($cols[2]->nodeValue);
	        $myobj->regNo = trim($cols[3]->nodeValue);
	        $myobj->age = trim($cols[4]->nodeValue);
	        $myobj->sex = trim($cols[5]->nodeValue);
	        $myobj->color = trim($cols[6]->nodeValue);
	        $myobj->country = trim($cols[7]->nodeValue);

	        
	        //var_dump($myobj);

	        array_push($myarray, $myobj);

	        //echo $myobj->horseID.'   '.$myobj->horseName.'   '.$myobj->regNo.'   '.$myobj->age.'   '.$myobj->sex.'   '.$myobj->color.'   '.$myobj->country."\n";
	}

	//echo json_encode($myarray);
		
	//$jsonData = json_encode($myarray);
}


?>