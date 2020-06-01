<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<?php $this->load->view("dependencies/css");
	       $this->load->view("components/headelements");?>
</head>
<body>
	<?php $this->load->view('components/navbar');?>
	<div class="container" style="height: 100vh;">
		
	</div>
	<?php $this->load->view("dependencies/js");?>
</body>
</html>