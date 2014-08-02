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
		margin:0 auto;
		border:thin solid #000;
		background:#efefef;
		width:350px;
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
	'name'=>'uname'
); 
 
$input_pass = array(
	'name'=>'pass'
); 
   
$input_checkbox = array(
	'name'=>'mem',
	'value' => '1'
);
   
 echo form_open(base_url().'index.php/welcome/login');
 echo form_label('Username');
 echo form_input($input_uname);
 echo form_label('Password');
 echo form_password($input_pass);
 echo form_label('Remember Me?');
 echo form_checkbox($input_checkbox);
 echo '<div class="clearfix"></div>';
 echo form_submit('','Submit');
 echo form_close(); 
 
 }else{
 	
	echo 'Logged In!';
 }
 
 ?>
 <div class="clearfix"></div>
</div>
 
</div>

</body>
</html>