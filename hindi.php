<?php include_once('common/header.php'); ?>
<!-- tab panes -->
<div class="row">
<div class="col-md-9 col-xs-12">
	<div id="video-cntr">
	</div>
						

</div>
<div class="col-md-3 col-xs-12">
<div id="prod_nav">	
<h4>PlayList</h4>		
	<ul class="item list-unstyled">
	</ul>
</div>
</div>
</div>

<!-- END navigator -->
<script src="assets/js/video.js"></script>
<script src="assets/js/videojs.ads.js"></script>
<script src="assets/js/app1.js"></script>
<script type="text/javascript">
	function createVideoElement(url){
			var video = $('<video />', {
				id: 'examplePlayer',
				src: url,
				type: 'video/mp4',
				controls: true,
				autoplay: true,
				class:'video-js vjs-default-skin'
			});
			video.appendTo($('#video-cntr'));
	}
$(document).ready(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
  var url='api/getfiles.php?type=1&val=1';
  $.getJSON(url, function(result){    
        $.each(result, function(i, field){
          var option_name = ('<li class="nextVideo"><a href="javascript:void(0);" class="current_action"><i class="fa fa-play-circle-o" aria-hidden="true"></i> <input type="hidden" class="current_file" value='+field.FilePath+'><strong>'+field.FileName+'</strong></a></li>');
            $(".item").append(option_name);
        });
        
        $('body').on('click','.current_action',function(){
			 var url=$(this).find('input').val();
			 $('#examplePlayer').length && videojs('examplePlayer').dispose();
			 createVideoElement(url);
			 setTimeout(function(){
				 abc(url);
			},1000);
		});
		$('.current_action').first().trigger('click');
    });
});
</script> 
<?php include_once('common/footer.php'); ?>

