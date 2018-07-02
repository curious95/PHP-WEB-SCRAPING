<?php

error_reporting(0);

// Array to store details of each horse
$myarray = array();

//Object to store details of each horse
$myobj = new stdClass();

//Max limit to be traveresed breaks if no tables are found
$limit = 999999;

//Creating a file to store the json
$myfile = fopen("horseDetails.json", "w") or die("Unable to open file!");


//Loop that will run until $limit or Untill the tables are found in html
for($i=0;$i<=$limit;$i++){

	//Loading the html files dynamically
	$URL = 'http://www.alltidhest.org/Horses/Page/'.$i;
	
	//Loading the contents of html file
	$html = file_get_contents($URL);
	
	echo $URL."\n";

	//echo $html;

	//Creating a DOM Object
	$dom = new domDocument;
	@$dom->loadHTML($html);
	$dom->preserveWhiteSpace = false;

	//Fetching the table from the page using the tag
	$tables = $dom->getElementsByTagName('table');

	//Fetching all the rows from the table
	$rows = $tables->item(0)->getElementsByTagName('tr');
	
	// Checking if we reached the end page...if so the scrapper stops and writes all the accumulated data to a json file
	if($rows->length <=1 or $i==$limit){
		//echo json_encode($myarray);
		fwrite($myfile, json_encode($myarray));
		fclose($myfile);
		break;
	}

	//Counter to omit the first row as it contains the headers name
	$j = 1;
	foreach ($rows as $row) {
	        
			
			if($j > 1) {
		        
		        //Fetching the columns of the selected row
		        $cols = $row->getElementsByTagName('td');
		        
		        //Initializing object for each row
		        $myobj = new stdClass();
		        // fetching all the required columns
		        $myobj->horseID = trim($cols[1]->nodeValue);
		        $myobj->horseName = trim($cols[2]->nodeValue);
		        $myobj->regNo = trim($cols[3]->nodeValue);
		        $myobj->age = trim($cols[4]->nodeValue);
		        $myobj->sex = trim($cols[5]->nodeValue);
		        $myobj->color = trim($cols[6]->nodeValue);
		        $myobj->country = trim($cols[7]->nodeValue);
		    
		        
		        //Adding all the elements to the final array
		        array_push($myarray, $myobj);
		    }
		    $j = $j+1;

	        //echo $myobj->horseID.'   '.$myobj->horseName.'   '.$myobj->regNo.'   '.$myobj->age.'   '.$myobj->sex.'   '.$myobj->color.'  '.$myobj->country."\n";
	}

}

?>