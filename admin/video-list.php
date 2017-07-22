<?php include_once('../autoload.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manage All Video</title>
<!-- Bootstrap -->
<link rel="stylesheet" href="<?php echo APP_PATH ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo APP_PATH ?>assets/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo APP_PATH ?>assets/css/mystyle.css">
</head>
<body>
<div class="container">
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand">Unicremind</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#">About Us</a></li>
		<li><a href="#">Contact Us</a></li>
		<li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
<div>
<div class="row">&nbsp;</div>

 <div class="panel panel-default">
      <div class="panel-heading"><h4>Manage Video Playlist</h4><a href="<?php echo ADMIN_FOLDER_PATH ?>" class="btn btn-info btn-sm" role="button">Add More Video</a></div>
      <div class="panel-body">
      <ul class="nav nav-pills" id="myProgramlistTabs">
<li class="list-video">
<a id="tab_11" class="foldername active" data-url="<?php echo API_FOLDER_PATH ?>getfiles.php?type=1&val=1"><i class="fa fa-play-circle-o" aria-hidden="true"> </i> Hindi</a>
</li>
<li  class="list-video"><a id="tab_13" class="foldername " data-url="<?php echo API_FOLDER_PATH ?>getfiles.php?type=1&val=3" href="javascript:void(0)"><i class="fa fa-play-circle-o" aria-hidden="true"> </i> Kannada</a>
</li>
<li class="list-video"><a id="tab_14" class="foldername " data-url="<?php echo API_FOLDER_PATH ?>getfiles.php?type=1&val=4" href="javascript:void(0)"><i class="fa fa-play-circle-o" aria-hidden="true"> </i> Malayalam</a>
</li>
<li class="list-video"><a id="tab_12" class="foldername" data-url="<?php echo API_FOLDER_PATH ?>getfiles.php?type=1&val=2" href="javascript:void(0)"><i class="fa fa-play-circle-o" aria-hidden="true"> </i> Tamil</a>
</li>
<li class="list-video"><a id="tab_15" class="foldername" data-url="<?php echo API_FOLDER_PATH ?>getfiles.php?type=1&val=5" href="javascript:void(0)"><i class="fa fa-play-circle-o" aria-hidden="true"> </i> Telugu</a>
</li>
<li class="list-video"><a id="tab_2" class="foldername" data-url="<?php echo API_FOLDER_PATH ?>getfiles.php?type=2" href="javascript:void(0)"><i class="fa fa-play-circle-o" aria-hidden="true"> </i> Advertisement</a>
</li>
</ul>
<div class="row">&nbsp;</div>
<table class="table table-hover">
    <thead>
      <tr>
      <th></th>
        <th>File Name</th>
        <th>Opertaion</th>
      </tr>
    </thead>
    <tbody class="program-list-content">
    </tbody>
  </table>
      </div>
    </div>
</div>
 </div>
 </div> 	
<!-- Script -->
<script src="<?php echo APP_PATH ?>assets/js/jquery-1.11.3.js"></script>	
<script src="<?php echo APP_PATH ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    $("#myProgramlistTabs li a").click(function() { 
        $(".program-list-content").empty();
        $("#myProgramlistTabs li a").removeClass('active');
        $(this).addClass('active');
        url=$(this).attr('data-url');
        current_id=$(this).attr('id');
        //var url='api/getfiles.php?type=1&val=1';
 		$.getJSON(url, function(result){    
        $.each(result, function(i, field){
          var filefullpath=field.DirPath+'/'+field.FileName;
          var row=i+1+'.';
          var option_name = ('<tr class="videolist_row"><td>'+row+'</td><td width="60%"><i class="fa fa-file-video-o" aria-hidden="true"></i>&nbsp; '+field.FileName+'&nbsp;</td><td width="40%"><a class="btn btn-danger btn-sm" onclick="delete_video(event, this , current_id)" href='+filefullpath+'><i class="fa fa-times-circle-o" aria-hidden="true"></i> Delete</a></td></tr>');
            $(".program-list-content").append(option_name);
            //console.log(option_name);
        });
    });
    return false;
    });

   // var today=$("#currrent_date").val();
    
 	var url='../api/getfiles.php?type=1&val=1';
    $(".program-list-content").empty();
    $.getJSON(url, function(result){    
        $.each(result, function(i, field){
          var filefullpath=field.DirPath+'/'+field.FileName;
          var row=i+1+'.';
          var option_name = ('<tr class="videolist_row"><td>'+row+'</td><td width="60%"><i class="fa fa-file-video-o" aria-hidden="true"></i>&nbsp; '+field.FileName+'&nbsp;</td><td width="40%"><a class="btn btn-danger btn-sm" onclick="delete_video(event, this, current_id)" href='+filefullpath+'><i class="fa fa-times-circle-o" aria-hidden="true"></i> Delete</a></td></tr>');
            $(".program-list-content").append(option_name);
            //console.log(option_name);
        });
    });
});



function delete_video(e, item, current_id) {

	var r=confirm("Are you sure delete this video?");
	if(r==true)
		{
			//return href;
	e = e || window.event;  //IE stuff
    e.preventDefault();     //prevent link click triggering
    e.returnValue = false;  //also prevent link click triggering (old IE style)
    var remove_path=item.getAttribute('href');
	$.ajax({
		type: "POST",
		url: 'delete-file-handler.php',
		data: 'FileName='+remove_path,
		success: function (data) {
      $(item).parents("tr").remove();
			 if(current_id=="tab_2")
			 {
				$.ajax({
				type: "POST",
				url: 'inventoryjsonfile-handler.php',
				data: 'FileName='+remove_path,
				success: function (data) {
				$(item).parents("tr").remove();
				}
				});
			 }
		}
	});

		}
	else
		{
			return false;
		} 
}


</script>

</body>
</html>