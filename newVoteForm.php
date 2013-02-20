<form id="newVoteForm" action="createNewVote.php" method="post" enctype="multipart/form-data">
	<table>
		<tr><td><span>Ask a question:</span></td><td><input id="vote-question" type="text" name="strQuestion"></td></tr>
		<tr><td><span>Set deadline:</span></td><td><input id="expire-date" type="date" name="strExpireDate"></td></tr>
		<tr><td colspan="2" id="uploadedImages"><input id="files-upload" name="objFiles[]" type="file" accept="image/gif, image/png, image/jpeg" multiple >
		<div id="uploadedImges" style="display:none">
		<table id="imgs">
			<tr>
			<td><canvas id="canvas_0" width=160 height=90 /></td>
			<td><canvas id="canvas_1" width=160 height=90 /></td>
			<td><canvas id="canvas_2" width=160 height=90 /></td>
			</tr>
		</table>
		</div>	
		</td></tr>
	</table>
<br>
<input type="radio" name="target" id="rPublic" value="public" checked="checked">public
<input type="radio" name="target" id="rPrivate" value="private">Only Friends
</br>
<div id="friendsDialog" title="Invite Friends">
	<?php include "getFriends.php"; ?>
</div>
<input type="hidden" id="hidIDs" name="AssignToIDs">
<input type="submit" name="submit1" value="Submit">
</form>
<br />


