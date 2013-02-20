<?php

if(!isset($userid))include "CommonDBFunctions.php";


//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

//echo json_encode($arr);
$tmpRow = mysql_fetch_row($result);
echo json_encode($tmpRow);
?>