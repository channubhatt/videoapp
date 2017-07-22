<?php include_once('common/header.php'); ?>
<!-- tab panes -->
<div class="row">
<div class="col-md-9">
	<video id="examplePlayer" class="video-js vjs-default-skin"
		width="1200" height="600" controls autoplay>
		<source id="video_data" type='video/mp4' src=""/>					
</video>
</div>
<div class="col-md-3">
<div id="prod_nav">	
<h4>PlayList</h4>		
	<ul class="item list-unstyled">
	</ul>
</div>
</div>
</div>
<script src="assets/js/video.js"></script>
<script src="assets/js/videojs.ads.js"></script>
<script src="assets/js/app.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
  var url='api/getfiles.php?type=1&val=3';
  $.getJSON(url, function(result){    
     $("#video_data, #examplePlayer_html5_api").attr('src', result[0].FilePath);
    console.log(result[0]);
        $.each(result, function(i, field){
          var option_name = ('<li class="nextVideo"><a href="javascript:void(0);" class="current_action"><i class="fa fa-play-circle-o" aria-hidden="true"></i> <input type="hidden" class="current_file" value='+field.FilePath+'><strong>'+field.FileName+'</strong></a></li>');
            $(".item").append(option_name);
        });
    });
});
});
</script> 

<?php include_once('common/footer.php'); ?>

