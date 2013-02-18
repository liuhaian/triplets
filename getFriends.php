<?php
//presumption
//$userid is defined at header
//$link for mysql is connected


//get all friends' user ids
  $friendResult=mysql_query('SELECT * from friends WHERE small_value_id = '.$userid.' or big_value_id = '.$userid.';',$link);
	if (!$friendResult) {
	    die('Invalid query on friends: ' . mysql_error());
	}
//browse each friend and get his full name
	if (mysql_num_rows($friendResult) > 0) {
    while ($rowFriends = mysql_fetch_assoc($friendResult)) {
    	$userRow=null;
    	if($rowFriends['small_value_id']==$userid){
    		$userRow=getUserInfo($rowFriends['big_value_id'],$link);
    	}else{
    		$userRow=getUserInfo($rowFriends['small_value_id'],$link);
      }
      if($userRow !== null){
      	echo '<input type="checkbox" name="toFriends[]" value="'.$userRow['id'].'" />'.$userRow['full_name'].' <br />';
      }

    }
	}