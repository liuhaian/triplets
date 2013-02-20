<?php 

include "CommonDBFunctions.php";

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
					text: "Vote",
					click: function() {
//						$("#voteForm").ajaxForm({url: 'voteAndComment.php', type: 'post'});

				    var url = "voteAndComment.php"; // the script where you handle the form input.
				
				    $.ajax({
				           type: "POST",
				           url: url,
				           data: $("#voteForm").serialize(), // serializes the form's elements.
				           async:false,
				           success: function(data)
				           {
				               alert(data); // show response from the php script.
				           }
				         });
//						$( this ).dialog( "close" );
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
		
		function doAjaxViewAndVoteForm(pageIndex){
	    var url = "viewAndVoteForm.php"; // the script where you handle the form input.
	
	    $.ajax({
	           type: "POST",
	           url: url,
				     data: "page="+pageIndex, // set page.
	           async:false,
	           success: function(data)
	           {
	               $("#dialog" ).html(data); // show response from the php script.
	           }
	         });
		}
		
		$( "#dialog" ).ready(function(){
	    $("#nextPageClick").click(function(e){ 
	//       alert("OK");
	       var currentPage=parseInt($("#currentPage").val());
	       currentPage++;
	       doAjaxViewAndVoteForm(currentPage);
	       $("#currentPage").val(currentPage);
	       e.preventDefault();
	       
	    });
	    $("#lastPageClick").click(function(e){ 
	//       alert("OK");
	       var currentPage=parseInt($("#currentPage").val());
	       currentPage--;
	       doAjaxViewAndVoteForm(currentPage);
	       $("#currentPage").val(currentPage);
	       e.preventDefault();
	       
	    });	  });	

		
		// Link to open the dialog
		$( "#dialog-link" ).click(function( event ) {
			if($("#spanVoteTaskCount").html()=="0")return;
			//Use Ajax to get dialog content
			doAjaxViewAndVoteForm(0);
	         //If it inludes multiple page, set next page visible.
			if(parseInt($("#spanVoteTaskCount").html())>1){
				$("#nextVote").show();
			}

    $("#nextPageClick").click(function(e){ 
//       alert("OK");
       var currentPage=parseInt($("#currentPage").val());
       currentPage++;
       doAjaxViewAndVoteForm(currentPage);
       $("#currentPage").val(currentPage);
       e.preventDefault();
       
    });

	     	
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
		echo '<br>';
		echo '<br>';
		echo 'You are invited to <a href="#" id="dialog-link" class="ui-state-default ui-corner-all"><span id="spanVoteTaskCount">'.$num.'</span></a> votes today!'; 
		?>
		</div>
<!-- ui-dialog -->
<div id="dialog" title="Invited Votes">
	
	<?php
//	include "viewAndVoteForm.php";
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