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
<div class="col-md-12">
 <div class="panel panel-default">
      <div class="panel-heading"><h4>Media File Manager</h4> <a class="btn btn-info btn-sm" href="<?php echo ADMIN_FOLDER_PATH ?>video-list.php">Manage All Videos</a>
         <!-- Trigger the modal with a button -->
      </div>
      <div class="panel-body">
<input type="button" class="btn btn-default btn-sm " name="btn_hindi" id="btn_hindi" value="Copy to Hindi Folder" onclick="movefilesfolder(1);">
        <input type="button" class="btn btn-danger btn-sm" name="btn_hindi" id="btn_hindi" value="Copy to Tamil Folder" onclick="movefilesfolder(2);">
        <input type="button" class="btn btn-warning btn-sm" name="btn_hindi" id="btn_hindi" value="Copy to Kannada Folder" onclick="movefilesfolder(3);">
        <input type="button" class="btn btn-success btn-sm" name="btn_hindi" id="btn_hindi" value="Copy to Malayalam Folder" onclick="movefilesfolder(4);">
        <input type="button" class="btn btn-info btn-sm" name="btn_hindi" id="btn_hindi" value="Copy to Telugu Folder" onclick="movefilesfolder(5);">
        <input type="button" class="btn btn-info btn-sm" name="btn_hindi" id="btn_hindi" value="Copy to Advertisement Folder" onclick="movefilesfolder(6);">
<div class="row">&nbsp;</div>




      <?php 
      $srcPath = SOURCE_FOLDER;
$destPath = FILE_PATH;
if(is_dir($srcPath))
            {
              ?>
              <table class="table table-hover">
    <thead>
      <tr>
      <th width="5%"></th>
        <th>File Name</th>
        
      </tr>
    </thead>
    <tbody class="program-list-content">
              <?php
$srcDir = opendir($srcPath);
$i=1;
while($readFile = readdir($srcDir))
{
    if($readFile != '.' && $readFile != '..')
    {
      
        if (!file_exists($readFile)) 
        {


           echo "<tr>";
      $data=pathinfo($readFile, PATHINFO_EXTENSION);
      if($data=="mp4")
      {
        echo "<td>";
        ?>
        <input class="videobutton" id="videobutton_<?php echo $i ?>" type='checkbox' value="<?php echo $readFile ?>" name="option[]" >
        <?php
        echo "</td>";
        echo "<td>";
        echo '<i class="fa fa-file-video-o" aria-hidden="true"></i> ';
        echo $readFile;
        echo "</td>";
        ?>
        <td>
        

        </td>
<?php
      } 
        echo "</tr>";
        }
        $i++;
    }
}
closedir($srcDir);
}
else{
  echo "No Media Device Found.";
}
      ?>
    </tbody>
  </table>
      </div>
    </div>
    </div>
    <div class="col-md-12">
     <div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-exchange" aria-hidden="true"></i> File Transfer History</div>
  <div class="panel-body">
    <div class="text-center" id="ajax_loader_wait" style="display: none;">
    <p>Uploading File. Please Wait ....</p>
    <img src="<?php echo APP_PATH ?>assets/images/ajax_loader.gif" class="loader_while_upload">
  </div>
    <div class="history_log">
    <div id="log"></div>
    </div>
  </div>
</div>
    </div>
</div>
 </div>
 </div> 	
<!-- Script -->
<script src="<?php echo APP_PATH ?>assets/js/jquery-1.11.3.js"></script>	
<script src="<?php echo APP_PATH ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
  function movefilesfolder(id){
    //alert(id);
     if (($("input[name*='option']:checked").length)<=0) {
        alert("You must check at least 1 video");
        return false;
    }
    if (!confirm('Are you sure copy file?')) return false;
     var allVals = [];
   $("input[name*='option']:checked").each(function() {
      allVals.push($(this).val());
   });
   var checkboxvalue=allVals.toString();
   $('#ajax_loader_wait').css('display','block');
   var request = $.ajax({
  url: "../api/readmediafolder.php",
  type: "POST",
  data: {ids : checkboxvalue, buttonvalue : id}
});

request.done(function(msg) {
   $('#ajax_loader_wait').css('display','none');
  $("#log").append( msg );
});

request.fail(function(jqXHR, textStatus) {
  alert( "Request failed: " + textStatus );
});

   //alert(checkboxvalue);
    return true;
  }
</script>

</body>
</html>
