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
</body>
</html>