<?php

$userid=1;
$username="haian";
$db_host		= 'localhost';
$db_user		= 'haianl';
$db_pass		= 'tester';
$db_database		= 'triplets';


$link = mysql_connect($db_host,$db_user,$db_pass); 

if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 

$db_selected =mysql_select_db($db_database,$link);
if (!$db_selected) {
    die ('Can\'t use triplets : ' . mysql_error());
}

//CommonDBFunctions
function getUserInfo($pUserID, $pLink){
	$tResultUser = mysql_query('select * from users WHERE id=\''.$pUserID.'\'',$pLink);
	$tUserRow=mysql_fetch_assoc($tResultUser);
	return $tUserRow;
};
