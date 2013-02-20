<?php
if(isset($_POST["userid"])){
$tmpUserId=$_POST["userid"];
}else if(isset($_GET["userid"])){
	$tmpUserId=$_GET["userid"];
}
$_SESSION['userid']=$tmpUserId;
echo $_SESSION['userid'];
?>