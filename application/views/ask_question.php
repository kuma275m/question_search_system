<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo base_url();?>statics/css/style.css" rel="stylesheet" media="screen" type="text/css" />
	<script charset="utf-8" src="<?php echo base_url()?>extension/kindeditor/kindeditor-min.js"></script>
	<script charset="utf-8" src="<?php echo base_url()?>extension/kindeditor/lang/en.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
	<title>Technique Question Search</title>
</head>
<body>
<?php $this->load->view('header');?>
	<div id="container">
		<div class="span20"></div>
		<div style="width:950px;height;auto;margin:0 auto;text-align:center;">
			<h1>TECHNIQUE QUESTION SEARCH</h1>
			<div style="clear:both;"></div>
			<form action="<?php echo base_url()."questionController/add_question" ?>" method="post" autocomplete="off" accept-charset="utf-8" id="search" onsubmit="return check(this)">
				<div style="width:950px; height:40px;text-align:left;" class="divheader">
				<div style="margin:10px;text-weight:bold;"><b>Ask Question</b></div>
				</div>
				<div style="width:950px; height:auto;margin:0 auto;text-align:left;border:1px solid #4d98e5;">
					<div style="width:400px;margin-left:20px;margin-top:10px;text-weight:bold;"><input style="width:400px;" id="question_title" name="question_title" value="" placeholder="Question Title" /><font id="username_message"></font></div>
					<div style="width:400px;margin-left:20px;margin-top:10px;text-weight:bold;">
						Category:
						<select id="category" name="category">
						<?php
							foreach($category as $row)
							{
								echo "<option value='".$row['id']."'>".$row['category_name']."</option>";
							}
						?>
						</select>
					</div>
					<div style="width:950px;margin-left:20px;margin-top:10px;text-weight:bold;">
						<textarea id="question_content" name="question_content" style="width:900px;padding:10px;" placeholder="Question Content"></textarea>
					</div>
					<br />
				</div>
				<br />
				<input type="submit" name="submit" value="Submit" />
				<br />
			</form>
			<br />
		</div>
	</div>
   
   <script language="javascript">

	function check(form) {
		    if($.trim(form.question_title.value)==""){
               alert("Please Input Question Title.");
               form.question_title.focus();
               return false;
           } 
		   	if($.trim(form.question_content.value)==""){
               alert("Please Input Question Content.");
               form.question_content.focus();
               return false;
           }
           return true;
	}
    function activeTag(tag,id) {
		<?php foreach ($category as $row) {
		?>
			$('#<?php echo $row['category_name'];?>').removeClass("navigation_active");
		<?php
		}?>
		$('#ALL').removeClass("navigation_active");
		$('#'+tag).addClass("navigation_active");
		$('#category').attr("value", id);
	}   

	var editor;

	KindEditor.ready(function(K) {
	editor = K.create('textarea[name="question_content"]', {
	    cssPath : '<?php echo base_url();?>extension/kindeditor/themes/simple/simple.css',
        filterMode : true,
		resizeType : 2,
		allowPreviewEmoticons : false,
		allowImageUpload : false,
		items : [
				'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image', 'link']
		});
	});	
    </script> 
</body>
</html>