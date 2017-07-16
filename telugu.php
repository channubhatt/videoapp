<?php include_once('common/header.php'); ?>
	<div class="row">
		  <!-- tab panes -->
		  <div id="prod_wrapper">
			
			<div style="width:800px;height:500px;">
			
			<video id="examplePlayer" class="video-js vjs-default-skin"
					width="800" height="500" controls autoplay>
					<source id="video_data" type='video/mp4' src=""/>					
			</video>
		
			</div>
			<!-- END tab panes -->
			<br clear="all">

			<!-- navigator -->
			<div id="prod_nav">			
				<ul class="item">
					
				</ul>
			</div>
			<!-- END navigator -->
		
		  <!-- END prod wrapper -->
    </div>
 </div>

<script type="text/javascript">
$(document).ready(function(){
  $(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
  var url='api/getfiles.php?type=1&val=5';
  $.getJSON(url, function(result){    
     $("#video_data, #examplePlayer_html5_api").attr('src', result[0].FilePath);
    console.log(result[0]);
        $.each(result, function(i, field){
          var option_name = ('<li class="nextVideo"><a href="javascript:void(0);" class="current_action"><img src="assets/images/1.png" alt=""><input type="hidden" class="current_file" value='+field.FilePath+'><strong>'+field.FileName+'</strong></a></li>');
            $(".item").append(option_name);
        });
    });
});
});
</script> 

<?php include_once('common/footer.php'); ?>

