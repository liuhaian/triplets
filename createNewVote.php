<?php
//Connect and open db
include "CommonDBFunctions.php";

//get all parameters $_POST["strQuestion"]

?>

<html>
<body>

<?php
var_dump($_POST);
echo 'created question:'.$_POST["strQuestion"];
echo '<br />';
echo 'Expire Darte:'.$_POST["strExpireDate"];

$target='./Images';
if($target[strlen($target)-1]!='/')$target=$target.'/';
$count=0;
foreach ($_FILES['objFiles']['name'] as $filename) 
{
    $temp=$target;
    $tmp=$_FILES['objFiles']['tmp_name'][$count];
    $count=$count + 1;
    $temp=$temp.basename($filename);
    move_uploaded_file($tmp,$temp);
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
?>

</body>
</html> 