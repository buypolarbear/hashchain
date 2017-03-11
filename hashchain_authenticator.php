<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <title>Hashchain Verification</title>
  
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

<body style='background-color:lightblue'>

  <div class="container" style="padding-top:30px;color:blue">
    <div style="margin-top:10px" class="notifications top-right"></div>

    <div id="content">
      <div class="hero-unit">
        <h3>Store your Electronic Record's hash in our blockchain<br/>
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
            <input id="action" type="hidden" name="action" value="upload">
            <button id="upload_submit" style="display: none;" type="submit" class="btn btn-success">
              <i class="icon-file"></i> Upload
            </button>
          </fieldset>
        </form>

        <div id="filedrag" style="background-color:lightblue" class="dropbox">
          <u>Click here</u> or drag and drop your file in this box.
        </div>

        <div id="explain"></div>		
        <div class="progress progress-striped">
          <div class="bar"></div>
        </div>
		<div id="bcResult"></div>
      </div>
  </div>




</body></html>