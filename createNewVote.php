<?php
//Connect and open db
include "CommonDBFunctions.php";

?>

<html>
<body>

<?php


//get all parameters $_POST["strQuestion"]
var_dump($_POST);
echo 'created question:'.$_POST["strQuestion"];
echo '<br />';
echo 'Expire Darte:'.$_POST["strExpireDate"];

$target='./Images';
if($target[strlen($target)-1]!='/')$target=$target.'/'.date("Y-m-d").'/'.$userid.'/';
if(!file_exists($target))mkdir($target,0777, true);
$fileList=array();
$count=0;
foreach ($_FILES['objFiles']['name'] as $filename) 
{
    $temp=$target;
    $tmp=$_FILES['objFiles']['tmp_name'][$count];
    $count=$count + 1;
    $temp=$temp.basename($filename);
    move_uploaded_file($tmp,$temp);
    array_push($fileList,$temp);
    $temp='';
    $tmp='';
}

echo '<br />';
echo 'target to:'.$_POST["target"];
echo '<br />';

echo 'Inviting frineds:'.$_POST["AssignToIDs"];
//if(!empty($_POST['toFriends'])) {
//    foreach($_POST['toFriends'] as $check) {
//            echo $check; //echoes the value set in the HTML form for each checked checkbox.
//                         //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
//                         //in your case, it would echo whatever $row['Report ID'] is equivalent to.
//    }
//}else{
//	echo "toFriends is empty.";
//}

echo '<br />';

//Insert DB

mysql_query("SET AUTOCOMMIT=0");
mysql_query("START TRANSACTION");

$a1 = mysql_query("INSERT INTO vote_task (title,owner, assign_to, expire_date) VALUES ('$_POST[strQuestion]','$userid','$_POST[AssignToIDs]','$_POST[strExpireDate]');");
$taskID=mysql_insert_id();
$a2 = mysql_query("INSERT INTO vote_item (id, task_id, img_url) VALUES('0','$taskID','$fileList[0]')");
$a3 = mysql_query("INSERT INTO vote_item (id, task_id, img_url) VALUES('1','$taskID','$fileList[1]')");
$a4 = mysql_query("INSERT INTO vote_item (id, task_id, img_url) VALUES('2','$taskID','$fileList[2]')");

if ($a1 and $a2 and $a3 and $a4) {
    mysql_query("COMMIT");
} else {        
    mysql_query("ROLLBACK");
}

?>
<a href="Triplets.php" class="button">Go Back<span></span></a>
</body>
</html> 