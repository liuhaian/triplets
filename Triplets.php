<?php 

include "CommonDBFunctions.php";

//SELECT * from vote_task WHERE expire_date > NOW() and assign_to REGEXP '1;'
$result = mysql_query('SELECT * from vote_task WHERE expire_date > NOW() and assign_to REGEXP \''.$userid.';\';',$link);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

$num=mysql_numrows($result);


?>


<!doctype html>
<html lang="us">
<head>
	<meta charset="utf-8">
	<title>Triplets</title>
	<link href="jQueryUI/css/ui-darkness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
	<script src="jQueryUI/js/jquery-1.9.0.js"></script>
	<script src="jQueryUI/js/jquery-ui-1.10.0.custom.js"></script>
	<script>
	$(function() {
		
		$( "#accordion" ).accordion();
		

		
		var availableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"BASIC",
			"C",
			"C++",
			"Clojure",
			"COBOL",
			"ColdFusion",
			"Erlang",
			"Fortran",
			"Groovy",
			"Haskell",
			"Java",
			"JavaScript",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags
		});
		

		
		$( "#button" ).button();
		$( "#radioset" ).buttonset();
		

		
		$( "#tabs" ).tabs();
		

		
		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 600,
			buttons: [
				{
					text: "Ok",
					click: function() {
						$( this ).dialog( "close" );
					}
				},
				{
					text: "Cancel",
					click: function() {
						$( this ).dialog( "close" );
					}
				}
			]
		});
		
		// Link to open the dialog
		$( "#dialog-link" ).click(function( event ) {
			$( "#dialog" ).dialog( "open" );
			event.preventDefault();
		});
		

		
		$( "#datepicker" ).datepicker({
			inline: true
		});
		

		
		$( "#slider" ).slider({
			range: true,
			values: [ 17, 67 ]
		});
		

		
		$( "#progressbar" ).progressbar({
			value: 20
		});
		

		// Hover states on the static widgets
		$( "#dialog-link, #icons li" ).hover(
			function() {
				$( this ).addClass( "ui-state-hover" );
			},
			function() {
				$( this ).removeClass( "ui-state-hover" );
			}
		);
		
		//Haian Added Feb 16
		$( "#friendsDialog" ).dialog({
			autoOpen: false,
			width: 400,
			buttons: [
				{
					text: "Ok",
					click: function() {
						$( this ).dialog( "close" );
					}
				},
				{
					text: "Cancel",
					click: function() {
						$( this ).dialog( "close" );
					}
				}
			]
		});
		
		$('[name="target"]').click(function(e){
			//alert(this.value);
			if(this.value == "private" ){
				$( "#friendsDialog" ).dialog( "open" );
			}else{
				$( "#friendsDialog" ).dialog( "close" );
			};
		}); 

		function upload (imgFile) {
						var xhr = new XMLHttpRequest();
						
//						// Update progress bar
//						xhr.upload.addEventListener("progress", function (evt) {
//							if (evt.lengthComputable) {
//								progressBar.style.width = (evt.loaded / evt.total) * 100 + "%";
//							}
//							else {
//								// No data to calculate on
//							}
//						}, false);
						
//						// File uploaded
//						xhr.addEventListener("load", function () {
//							progressBarContainer.className += " uploaded";
//							progressBar.innerHTML = "Uploaded!";
//						}, false);
				
						xhr.open("post", "uploadImage.php", true);
						
//						// Set appropriate headers
//						xhr.setRequestHeader("Content-Type", "multipart/form-data");
//						xhr.setRequestHeader("X-File-Name", imgFile.name);
//						xhr.setRequestHeader("X-File-Size", imgFile.size);
//						xhr.setRequestHeader("X-File-Type", imgFile.type);
				
						// Send the file (doh)
						var formData = new FormData();
						formData.append("file", imgFile);
						xhr.send(formData);
		};

    
    function previewFile(objFile, intIndex){
				var canvas=document.getElementById("canvas_"+intIndex);
				var ctx = canvas.getContext("2d");
	    	ctx.clearRect(0,0,320,180);
				// from an input element
//				var filesToUpload = this.files;
//				var file = filesToUpload[0];
				var file = objFile;

				var reader = new FileReader();  
				reader.onload = function(e) {img.src = e.target.result}
				reader.readAsDataURL(file);

				
				var img = document.createElement("img");
				img.onload = function(){
//					canvas.width = img.width;
//					canvas.height = img.height;
// if img is 600*500(ratio 1.2) then we'll draw a 216*180 pic to make height full.
// if img is 600*200(ratio 3) then we'll draw a 320*107 pic to make width full.
					var ratio=img.width/img.height;
//					var drawWidth=320;
//					var drawHeight=180;
//					if(ratio<1.78){
//						drawWidth=180*ratio;
//					}else{
//						drawHeight=320/ratio;
//					}
					var drawWidth=160;
					var drawHeight=90;
					var drawStartX=0;
					var drawStartY=0;
					if(ratio<1.78){
						drawWidth=90*ratio;
						drawStartX=(160-drawWidth)/2;
					}else{
						drawHeight=160/ratio;
						drawStartY=(90-drawHeight)/2;
					}
					ctx.drawImage(img, drawStartX, drawStartY,drawWidth,drawHeight);
				};
//
				var dataurl = canvas.toDataURL("image/png");
				return dataurl;
//				alert(dataurl);
    	
    };
    
		$("#files-upload").change( function () {
			if(this.files.length!==3){
				alert('please select 3 image files!');
				return;
			}
        var imgDatalist=new Array();
				for (var i=0, l=this.files.length; i<l; i++) {		
					//alert('Handler for .change() called.');
	//				upload(this.files[i]);
						imgDatalist[i]=previewFile(this.files[i],i);
	//				eval("$(\"#img"+i+"\").src=\"Images/"+this.files[i].name+"\";");
				}
				//$(this).hide();
				$("#uploadedImges").show();
			});

			//Before submit to create a new vote do input check.
			$("#newVoteForm").submit(function(e) {
//				e.preventDefault();
//				alert("submit canceled");
//				alert("vote-question value:"+$("#vote-question").val());
//				alert("expire date:"+$("#expire-date").val());
//				alert("Files count:"+$("#files-upload").get(0).files.length);
//				alert("Vote type:"+$('input:radio[name="target"]:checked').val());
//				alert("how many friends are selected:"+$('input:checkbox[name="toFriends[]"]:checked').length);
	        
//				//Input check.
				  if ($("#vote-question").val() == "") {
				    e.preventDefault();
				    alert("please ask a question!");
				    return false;
				  }
				  if ($("#expire-date").val() == "" || (new Date($("#expire-date").val())) < Date.now() ) {
				    e.preventDefault();
				    alert("please input a date in the future.");
				    return false;
				  }
				  if ($("#files-upload").get(0).files =="undefined"){
				    alert("please select 3 images.");
				    e.preventDefault();
				    return false;
				  }else{
				  	if($("#files-upload").get(0).files.length !== 3){
					    alert("please select 3 images.");
					    e.preventDefault();
					    return false;
				  	}
				  }

				  if (($('input:radio[name="target"]:checked').val() == "private") && ($('input:checkbox[name="toFriends[]"]:checked').length == 0)  ) {
//				  if ($("#rPrivate").is(':checked') ) {
				    alert("please select some friends.");
				    e.preventDefault();
				    return false;
				  }
				  
				  //Get IDs to set into hidden
				  var strIDs="";
	        $('input:checkbox[name="toFriends[]"]:checked').each(function(){
	          strIDs = strIDs+$(this).val()+";";
	        });
//	        alert("OK"+strIDs);
	        $("#hidIDs").val(strIDs);


				  
				  return true;
				});
		
	});
	</script>
	<style>
	body{
		font: 62.5% "Trebuchet MS", sans-serif;
		margin: 50px;
	}
	.demoHeaders {
		margin-top: 2em;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	</style>
</head>
<body>
<!-- Tabs -->
<h2 class="demoHeaders">Tabs</h2>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">New Votes from Friends</a></li>
		<li><a href="#tabs-2">Create My Own Votes</a></li>
		<li><a href="#tabs-3">Public Votes</a></li>
	</ul>
	<div id="tabs-1">
		<?php
		echo 'hello '. $username.'!';
		echo '<br>';
		echo 'You are invited to <a href="#" id="dialog-link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>'.$num.'</a> votes today!'; 
		?>
		</div>
<!-- ui-dialog -->
<div id="dialog" title="Invited Votes">
	<?php
	$row = mysql_fetch_row($result);
	$taskId=$row[0];
	$ownerid=$row[2];
	$strQuestion=$row[1];
	$strDeadline=$row[3];
	//echo 'debug:'.$ownerid;
	
	$resultUser = mysql_query('select * from users WHERE id=\''.$ownerid.'\'',$link);
	$userRow=mysql_fetch_row($resultUser);

	$ownername=$userRow[1];
	echo '<p>'.$ownername.' asks:</p><p>'.$strQuestion.'</p>';
	
	
	$resultVoteItem=mysql_query('select * from vote_item WHERE task_id=\''.$taskId.'\';');

	if (mysql_num_rows($resultVoteItem) > 0) {
    while ($rowVoteItem = mysql_fetch_assoc($resultVoteItem)) {
        echo '<img src="'.$rowVoteItem['img_url'].'" width=150 height=100 />';
    }
	}
	?>
</div>
	<div id="tabs-2">
		<?php include("newVoteForm.php"); ?>
	</div>
	<div id="tabs-3">Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.</div>
</div>
</body>
<?php
mysql_close($link); 
?>
</html>