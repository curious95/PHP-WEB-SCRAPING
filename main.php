<?php

//Loading the html files dynamically
$html = file_get_contents('http://www.alltidhest.org/Horses/Page/1');

//echo $html;

//Creating a DOM Object
$dom = new domDocument;
@$dom->loadHTML($html);
$dom->preserveWhiteSpace = false;

$tables = $dom->getElementsByTagName('table');

var_dump($tables);

$rows = $tables->item(0)->getElementsByTagName('tr');

foreach ($rows as $row) {
        $cols = $row->getElementsByTagName('td');
        echo $cols[2]->nodeValue;
}


?>