<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Persistent Login</title>

	<style type="text/css">
	#container{
		width:100%;
		
	}
	.wrap{
		margin:0 auto 10px;
		border:thin solid #000;
		background:#efefef;
		width:350px;
		min-height:200px;
		padding:10px;
	}
	.wrap label,.wrap input{
		margin:5px;
	}
	.wrap label{
		float:left;
	}
	.wrap input{
		float:right;
	}
	.clearfix{
	 clear: both;	
	}
	</style>
</head>
<body>

<div id="container">

<div class="wrap">	
	<h2>Login</h2>
 <?php
 
 
 if(!$this->session->userdata('logged_in')){
 	
$form = array(
	'action'
);
$input_uname = array(
	'name'=>'username'
); 
 
$input_pass = array(
	'name'=>'password'
); 

$input_checkbox = array(
	'name'=>'persistent',
	'value' => '1'
);   
 echo form_open(base_url().'index.php/welcome/login');
 echo form_label('Username');
 echo form_input($input_uname);
 echo $this->session->flashdata('username_error');
 echo form_label('Password');
 echo form_password($input_pass);
 echo $this->session->flashdata('password_error');
 echo form_label('Remember Me?');
 echo form_checkbox($input_checkbox);
 echo '<div class="clearfix"></div>';
 echo form_submit('','Submit');
 echo form_close(); 
 
?>
<div class="clearfix"></div>
</div>

<div class="wrap">	
	<h2>Register</h2>
<?php

// ++++++++ REGISTER ++++++++++++ //
 	
$form = array(
	'action'
);
$reg_input_uname = array(
	'name'=>'reg_username'
); 
 
$reg_input_pass = array(
	'name'=>'reg_password'
); 
   
 echo form_open(base_url().'index.php/welcome/register');
 echo form_label('Username');
 echo form_input($reg_input_uname);
 echo $this->session->flashdata('reg_username_error');
 echo form_label('Password');
 echo form_password($reg_input_pass);
 echo $this->session->flashdata('reg_password_error');
 echo '<div class="clearfix"></div>';
 echo form_submit('','Submit');
 echo form_close(); 
  
 } 
 ?>
 <div class="clearfix"></div>
</div>
 
</div>

</body>
</html>