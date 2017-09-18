<?php include_once('autoload.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Unicremind</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/video-custom.css">

<link rel="stylesheet" href="assets/css/mystyle.css">

<link rel="stylesheet" href="assets/css/video-js.css">
<link rel="stylesheet" href="assets/css/videojs.ads.css">
<link rel="stylesheet" href="assets/css/app.css">
<!-- Script -->
<script src="assets/js/jquery-1.11.3.js"></script>

<body>
<div id="preloader"></div>
<div class="container">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?php echo APP_PATH ?>">Unicremind</a>
    </div>
    <input type="hidden" id="interval_value" name="interval_value" value="<?php echo VIDEO_INTERVAL; ?>">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#">About Us</a></li>
		<li><a href="#">Contact Us</a></li>
		<li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</nav>