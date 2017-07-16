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
	
	// $('.current_action').on('click',function(){
	// 	alert("dddd");
	// 	 var value=$('.current_file').val();
	// 	 console.log(value);
	// });
	
});


