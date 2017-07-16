<?php include_once('autoload.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Video Player</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- Bootstrap -->
  <link rel="stylesheet" href="<?php echo APP_PATH ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo APP_PATH ?>assets/css/video-front.css">
</head>
<body>
<div class="container">
<figure id="video_player">
  <video controls poster="nambia1.jpg">
    <source src="nambia1.mp4" type="video/mp4">
    <source src="nambia1.webm" type="video/webm">
  </video>
  <figcaption>
    <a href="nambia1.mp4"><img src="nambia1.jpg" alt="Nambia Timelapse 1"></a>
    <a href="nambia2.mp4"><img src="nambia2.jpg" alt="Nambia Timelapse 2"></a>
    <a href="nambia3.mp4"><img src="nambia3.jpg" alt="Nambia Timelapse 3"></a>
  </figcaption>
</figure>
</div>
<!-- Script -->
<script src="<?php echo APP_PATH ?>assets/js/jquery-1.11.3.js"></script>  
<script src="<?php echo APP_PATH ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo APP_PATH ?>assets/js/custom.js"></script>

<script type="text/javascript">
    var video_player = document.getElementById("video_player");
    console.log(video_player);
links = video_player.getElementsByTagName('a');

//console.log(links);

for (var i=0; i<links.length; i++) {
  links[i].onclick = handler;
}

function handler(e) {
  e.preventDefault();
  videotarget = this.getAttribute("href");
  filename = videotarget.substr(0, videotarget.lastIndexOf('.')) || videotarget;
  video = document.querySelector("#video_player video");
 // video.removeAttribute("controls");
  video.removeAttribute("poster");
  source = document.querySelectorAll("#video_player video source");
  source[0].src = filename + ".mp4";
  source[1].src = filename + ".webm";
  video.load();
  video.play();    
}

  </script>

</body>
</html>
