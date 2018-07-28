<?php
	include_once 'header.php';
?>

	<div class="hero-unit">
		<h3>Verify Electronic Record<br/>
		<small>Your file will NOT be uploaded to our servers. The hash value of your file will be calculated in your browser.</small>
		</h3>

		<div id="wait" class="row" style="display: none;">
			<div class="spinner">
				<div class="rect1"></div>
				<div class="rect2"></div>
				<div class="rect3"></div>
				<div class="rect4"></div>
				<div class="rect5"></div>
			</div>
			Loading...
		</div>

		<form id="upload_form" style="display: none;" method="POST" enctype="multipart/form-data" action="">
			<fieldset>
				<input id="file" type="file" name="d" onchange="bcResult.innerHTML = '';">
				<input id="action" type="hidden" name="action" value="verify">
				<button id="upload_submit" style="display: none;" type="submit" class="btn btn-success">
				<i class="icon-file"></i> Upload
				</button>
			</fieldset>
		</form>

		<div id="filedrag" class="dropbox">
			<u>Click here</u> or drag and drop your file in this box.
		</div>

		<div id="explain"></div>		
		<div class="progress progress-striped">
			<div class="bar"></div>
		</div>
		<div id="bcResult"></div>
	</div>

<?php
	include_once 'footer.php';
?>