<?php
	$path = basename($_SERVER['PHP_SELF']); 
	$page_name = pathinfo($path, PATHINFO_FILENAME);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<?php if ($page_name == 'upload'): ?>
			<title>Hashchain - Upload</title>
		<?php else: ?>
			<title>Hashchain - Verification</title>
		<?php endif ?>
		
		<meta http-equiv="X-UA-Compatible" content="chrome=1">
		<meta name="description" content="BIG-Chain">
		<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/favicon.png">


		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-notify.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">

		<script async="" src="js/analytics.js"></script>
		<script type="text/javascript" src="js/jquery.1.8.0.min.js"></script>
		<script type="text/javascript" src="js/jquery.form.js"></script>
		<script type="text/javascript" src="js/crypto.js"></script>
		<script type="text/javascript" src="js/sprintf.js"></script>
		<script type="text/javascript" src="js/filedrop.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/bootstrap-notify.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
	
	</head>

	<?php if ($page_name == 'upload'): ?>
		<body style='background-color:lightblue'>	
	<?php else: ?>
		<body style='background-color:lightgreen'>
	<?php endif ?>
	

		<div class="container" style="padding-top:30px;;color:green">
			<div style="margin-top:10px;" class="notifications top-right"></div>

			<div id="content">
				<span style="font-size: 18px; font-weight: bold">
					<a href="upload.php">Upload</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
					<a href="verifier.php">Verify</a>
				</span><br><br>
			