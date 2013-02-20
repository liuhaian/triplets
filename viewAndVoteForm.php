<?php


if(!isset($userid))include "CommonDBFunctions.php";

$currentPage=0;
if(isset($_POST["page"])){
$currentPage=$_POST["page"];
}else if(isset($_GET["page"])){
	$currentPage=$_GET["page"];
}

function getFirstTask($pTaskList){
	$elementCount=count($pTaskList);
	for($iTaskIndex=0; $iTaskIndex < $elementCount;$iTaskIndex++){
		if($_SESSION['pageShowFlas'][$iTaskIndex])return $pTaskList[$iTaskIndex];
	}
	return null;
}

function get_Nth_Task($pTaskList,$pNth){
 return $pTaskList[$pNth];
}

//Browse Vote Tasks
$rowVoteTaskList=array();
//once it is voted the vote task shouldn't be shown in the dialog any more. Use this flag.
$ifShowInBrowse=array();
$VoteCount=0;

	if ($num > 0) {
    while ($tmpRow = mysql_fetch_row($result)) {
//        echo '<input type="radio" name="votePics" value=$rowVoteItem["id"]><img src="'.$rowVoteItem['img_url'].'" width=150 height=100 />';
				array_push($rowVoteTaskList,$tmpRow);
        array_push($ifShowInBrowse,true);
        $VoteCount++;
    }
    $_SESSION['pageShowFlas']=$ifShowInBrowse;
	}
	
	//get First
//	$row=$rowVoteTaskList[0];
//	$row=getFirstTask($rowVoteTaskList);
	$row=get_Nth_Task($rowVoteTaskList,$currentPage);
	$taskId=$row[0];
	$ownerid=$row[2];
	$strQuestion=$row[1];
	$strDeadline=$row[3];

	//echo 'debug:'.$ownerid;

$resultUser = mysql_query('select * from users WHERE id=\''.$ownerid.'\'',$link);
$userRow=mysql_fetch_row($resultUser);

$ownername=$userRow[1];
//	echo '<p>'.$ownername.' asks:</p><p>'.$strQuestion.'</p>';

	
	
	$resultVoteItem=mysql_query('select * from vote_item WHERE task_id=\''.$taskId.'\';');
  $img_url_list=array();
	if (mysql_num_rows($resultVoteItem) > 0) {
    while ($rowVoteItem = mysql_fetch_assoc($resultVoteItem)) {
//        echo '<input type="radio" name="votePics" value=$rowVoteItem["id"]><img src="'.$rowVoteItem['img_url'].'" width=150 height=100 />';
        array_push($img_url_list,$rowVoteItem['img_url']);
    }
	}
 ?>
 
<form id="voteForm">
<table>
	<tr>
		<td><?php echo $ownername." "; ?>asks:</td><td colspan=2><?php echo $strQuestion; ?></td>
</tr>
<tr>
	<td colspan=3>
	<?php
    for ($iPics=0;$iPics<3;$iPics++) {
        echo '<input type="radio" name="votePics" value="'.$iPics.'"><img src="'.$img_url_list[$iPics].'" width=150 height=100 />';
    }
	?>
	<td>
</tr>
<tr>
	<td>Post your comment:</td>
	<td colspan=2><input type="text" name="strComment"></td>
</tr>
<tr>
<?php
if($currentPage >0){
?>
	<td><div id="lastVote"><a href="#" id="lastPageClick">Last Page</div></td>
<?php
}else{
	?>
	<td><div id="lastVote" style="display:none"><a href="#" id="lastPageClick">Last Page</div></td>
<?php
}
?>
	<td><span id="spIfVoted"></td>
<?php
if($currentPage < (count($ifShowInBrowse)-1)){
?>
	<td align="right"><div id="nextVote"><a href="#" id="nextPageClick">Next Page<a></td>
<?php
}else{
	?>		
	<td align="right"><div id="nextVote" style="display:none"><a href="#" id="nextPageClick">Next Page<a></td>
</tr>
<?php
}
?>
<input type="hidden" id="currentPage" name="currentPosition" value="0">
</table>
</form>
