<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo base_url();?>statics/css/style.css" rel="stylesheet" media="screen" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
	<title></title>
</head>
<body>
<?php $this->load->view('header');?>
	<div id="container">
		<div class="span20"></div>
		<div style="width:600px;height;auto;margin:0 auto;text-align:center;">
		<h1>TECHNIQUE QUESTION SEARCH</h1>
		<div class="span20"></div>
		<?php
			if(isset($message)) {
			echo $message;
			}
		?>
		</div>
	</div>
<?php $this->load->view('footer');?>
</body>
</html>