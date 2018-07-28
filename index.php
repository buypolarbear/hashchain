<?php
	
	$page = (isset($_GET['page'])) ? $_GET['page'] : null;

	if (is_null($page) || $_GET['page'] == 'upload') {
		header("location:upload.php");
	}
	else if($_GET['page'] == 'verifier') {
		header("location:verifier.php");
	}
	else {
		echo "<h2 style='color: red'> Invalid request</h2>";
	}

?>