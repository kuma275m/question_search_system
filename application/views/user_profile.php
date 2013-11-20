<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo base_url();?>statics/css/style.css" rel="stylesheet" media="screen" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
	<title><?php echo $this->session->userdata('username');?></title>
</head>
<body>
<?php $this->load->view('header');?>
	<div id="container">
		<h1>TECHNIQUE QUESTION SEARCH</h1>
				<div class="span20"></div>
			<div style="width:620px;height:40px;text-align:left;" class="divheader">
			<div style="margin:10px;text-weight:bold;"><b>User Profile</b></div>
			</div>
			<div style="width:600px; height:auto;padding:10px;text-align:left;border:1px solid #4d98e5;">
				<b><?php echo $this->session->userdata('username');?></b>
				<br />
				<p>Ask: <b><?php echo $profile['ask_times'];?></b>   Reply: <b><?php echo $profile['reply_times'];?></b></p>
				<p style="text-align:right;">
				<input type="button" id="Change_Password" name="Change_Password" value="Change Password" onclick="show_change_password();" />
				<a href="<?php echo base_url();?>questionController/ask_question"><input type="button" id="Ask_Question" name="Ask_Question" value="Ask Question" /></a>
					<div id="wall">
						<div style="text-align:center;" class="divheader">
							<div style="margin:10px;text-weight:bold;"><b>Change Password</b></div>
						</div>
						<div style="padding:20px;margin:0 auto;text-align:center;">
							<form action="<?php echo base_url()."userController/change_password"; ?>" method="post" accept-charset="utf-8" id="search" autocomplete="off" onsubmit="return chkpassword(this)">
								<input type="password" name="new_password" value="" id="new_password" placeholder="New Password" /><br /><br />
								<input type="password" name="confirm_password" value="" id="confirm_password" placeholder="Confirm Password" /><br /><br />
								<input type="submit" name="submit" value="Submit" /><input type="button" style="height:40px;" name="cancel" value="Cancel" onclick="show_change_password();" /><br />
							</form>
						</div>
					</div>
				</p>
				
			</div>
			<br />
			<div style="width:620px;height:40px;text-align:left;" class="divheader">
			<div style="margin:10px;text-weight:bold;"><b>My Questions</b></div>
			</div>
			<div style="width:600px; height:auto;padding:10px;text-align:left;border:1px solid #4d98e5;">
				<?php
					foreach($question_list as $row)
					{
						echo "<p style='border-bottom:1px dashed #4d98e5;'><a href='".base_url()."questionController/show_question/?id=".$row['id']."' target='_blank'>".$row['question_title']."</a>    <font style='font-size:10px;'> ".$row['add_time']."</font></p>";
					}
				?>
			</div>
		<div class="span60"></div>
	</div>
	<script>
		function show_change_password() {
			if($("#wall").is(":hidden"))
			{
				$("#wall").slideToggle(400,function(){$('#wall').css("display", "block");});
			}
			else
			{
				$("#wall").slideToggle(400,function(){$('#wall').css("display", "none");});
			}
		}
		function chkpassword(form) {
			if($.trim(form.new_password.value)==""){
               alert("Please input new password.");
               form.new_password.focus();
               return false;
           } 
		   	if($.trim(form.confirm_password.value)==""){
               alert("The password is not matched.");
               form.confirm_password.focus();
               return false;
           }
		   	if($.trim(form.new_password.value)!=$.trim(form.confirm_password.value)){
               alert("Please confirm your password.");
               form.confirm_password.focus();
               return false;
           }
		}
	</script>
</body>
</html>