<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo base_url();?>statics/css/style.css" rel="stylesheet" media="screen" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
	<title>Register User</title>
</head>
<body>
<?php $this->load->view('header');?>
	<div id="container">
		<div class="span20"></div>
		<div style="width:600px;height;auto;margin:0 auto;text-align:center;">
		<h1>TECHNIQUE QUESTION SEARCH</h1>
		<div class="span20"></div>
			<form action="<?php echo base_url()."userController/register_confirm" ?>" method="post" autocomplete="off" accept-charset="utf-8" id="search" onsubmit="return check(this)">
				<div style="width:600px; height:40px;text-align:left;" class="divheader">
				<div style="margin:10px;text-weight:bold;"><b>User Register</b></div>
				</div>
				<div style="width:600px; height:auto;margin:0 auto;text-align:right;border:1px solid #4d98e5;">
				<div style="width:400px;margin-left:50px;margin-top:10px;text-weight:bold;">Username:<input style="width:200px;" id="username" name="username" value="" onblur="check_username(this.value)" placeholder="Mandatory Field" /><font id="username_message"></font></div>
				<div style="width:400px;margin-left:50px;margin-top:10px;text-weight:bold;">Password:<input type="password" style="width:200px;" id="password" name="password" value="" placeholder="Mandatory Field" /><font id="password_message"></font></div>
				<div style="width:400px;margin-left:50px;margin-top:10px;text-weight:bold;">Confirm Password:<input type="password" style="width:200px;" id="confirm_password" name="confirm_password" value="" placeholder="Mandatory Field" /><font id="password_c_message"></font></div>
				<div style="width:400px;margin-left:50px;margin-top:10px;text-weight:bold;">E-mail:<input style="width:200px;" id="email" name="email" value="" onblur="check_email(this.value)" placeholder="Mandatory Field" /><font id="email_message"></font></div>
				<div style="width:400px;margin-left:50px;margin-top:10px;text-weight:bold;">Phone:<input style="width:200px;" id="phone" name="phone" value="" placeholder="Optional" /><font id="phone_message"></font></div>
				<br />
				</div>
				<br />
				<input type="submit" name="register" value="Register" />
				<br />
			</form>
		<div class="span60"></div>
		</div>
	</div>
    <?php $this->load->view('footer');?> 
	<script language="javascript">
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			function check_username(form) {
			var username = form;

			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					if(xmlhttp.responseText==1)
					{
					//alert(xmlhttp.responseText);
					alert('This username has been registered.');
					//form.username.focus();
					}
				}
			}
			xmlhttp.open("GET","<?php echo base_url()?>userController/check_username?username="+username,true);
			xmlhttp.send();	
			}
			function check_email(email) {
			var email = email;
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					if(xmlhttp.responseText==1)
					{
					//alert(xmlhttp.responseText);
					alert('This email has been used for another account.');
					//form.username.focus();
					}
				}
			}
			xmlhttp.open("GET","<?php echo base_url()?>userController/check_email?email="+email,true);
			xmlhttp.send();	
			}
		function check(form) {
		    if($.trim(form.username.value)==""){
               alert("Please Input Username.");
               form.username.focus();
               return false;
           } 
		   	if($.trim(form.password.value)==""){
               alert("Please Input Password.");
               form.password.focus();
               return false;
           }
		   	if($.trim(form.password.value)!=$.trim(form.confirm_password.value)){
               alert("Please confirm your password.");
               form.confirm_password.focus();
               return false;
           }
		   	if($.trim(form.email.value)==""){
               alert("Please input your Email.");
               form.email.focus();
               return false;
           }		   
           return true;
	}
	</script>
</body>
</html>