<div id="header">
	<div class="span10"></div>
	<?php
		if (!$this->session->userdata('is_logged_in')) {
		$form_attribute = array('id' => 'login', 'autocomplete' => 'off', 'onsubmit' => 'return checklogin(this)');
		echo form_open('/main/login_validation', $form_attribute);
	?>
	<div style="float:right;margin-right:50px;">
	<a href="<?php echo base_url();?>"><input type="button" id="home" name="home" value="Home" /></a>
	<?php
		$input_username = array ('name' => 'username', 'id' => 'username', 'class' => 'logininput', 'maxlength' => '50', 'placeholder' => 'Username');
		echo form_input($input_username);
		$input_password = array ('name' => 'password', 'id' => 'password', 'class' => 'logininput', 'maxlength' => '50', 'placeholder' => 'Password');
		echo form_password($input_password);
		$input_submit = array ('type' => 'submit', 'name' => 'login', 'value' => 'Login', );
		echo form_submit($input_submit);
	?>
	<a href="<?php echo base_url();?>main/register"><input type="button" id="register" name="register" value="Register" /></a>
	</div>
	<?php	
		echo form_close();
		}
		else {
			?>
			<div style="float:right;margin-right:50px;">
			<a href="<?php echo base_url();?>"><input type="button" id="question" name="question" value="Home" /></a>
			<a href="<?php echo base_url();?>userController/my_profile"><input type="button" id="question" name="question" value="<?php echo $this->session->userdata('username');?>" /></a>
			<a href="<?php echo base_url()."main/logout" ?>"><input type="button" id="logout" name="logout" value="Logout" /></a>
			</div>
			<?php
		}
	?>
	<script language="javascript">
	function checklogin(form) {
		if($.trim(form.username.value)==""){
            alert("Please input username.");
            form.username.focus();
            return false;
        } 
		if($.trim(form.password.value)==""){
            alert("Please input password.");
            form.password.focus();
            return false;
        } 
        return true;
	}
	</script>
</div>