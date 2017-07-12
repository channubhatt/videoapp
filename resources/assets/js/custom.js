var player;
$(function(){
	$('#videoLang').on('change',function(){
		$('#nextLink').attr('href',$('#videoLang').val());
	});
	
	/*$('.nextVideo').on('click',function(){
		
		var fileName = $(this).find('strong').text();
		fileName += ".mp4";
		setupPlayer(fileName);
	});*/
	
	$('#nextLink').on('click',function(){
		var href = $(this).attr('href');
		if(href == '')
		alert("Movie with this language is not available.");
	});
	
});

/*function setupPlayer(fileName){
	player.setup({
		file: fileName,
		width: 800,
		height: 500,
		autostart: true
	  });
}*/

$(document).ready(function(){
	//player = jwplayer('player')
});
